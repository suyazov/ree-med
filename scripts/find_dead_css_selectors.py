#!/usr/bin/env python3
"""CSS selector audit: static check for potentially unused class selectors."""

import pathlib
import re

ROOT = pathlib.Path('.')
CSS_FILES = list(ROOT.glob('assets/css/*.css')) + [ROOT / 'style.css']

CODE_FILES = []
for ext in ('php', 'js', 'html'):
    CODE_FILES.extend(ROOT.glob(f'**/*.{ext}'))

IGNORE_SELECTORS = {
    'container',
    'section',
    'style',
}

RUNTIME_CLASSES = {
    'sub-menu',
    'menu-item-has-children',
}

selector_re = re.compile(r'\.[A-Za-z_][A-Za-z0-9_:-]*')
comment_re = re.compile(r'/\*.*?\*/', re.S)
class_attr_re = re.compile(r'class\s*=\s*(?:"[^"]*"|\'[^\']*\')', re.I | re.S)
class_key_re = re.compile(r'["\']([^"\']*class[^"\']*)["\']\s*=>\s*["\']([^"\']+)["\']', re.I)
query_selector_re = re.compile(r'querySelector(?:All)?\([^)]*(?:"[^"]*"|\'[^\']*\')')
js_class_method_re = re.compile(r'classList\.(?:add|remove|toggle)\([^)]*(?:"[^"]*"|\'[^\']*\')')
concat_prefix_re = re.compile(r'([A-Za-z_][A-Za-z0-9_-]*--)\s*\.\s*\$')


def normalize_classes(value):
    if not value:
        return []

    clean = re.sub(r'\s*<\?php.*?\?>\s*', ' ', value, flags=re.S)
    clean = re.sub(r'[^A-Za-z0-9_\-\s:]+', ' ', clean)
    return re.split(r'\s+', re.sub(r'\s+', ' ', clean.strip()))


def parse_used_classes(code_text):
    used = set()
    dynamic_prefixes = set()

    for match in class_attr_re.finditer(code_text):
        classes_attr = match.group(0)
        raw_classes = classes_attr.split('=', 1)[1] if '=' in classes_attr else ''
        classes = raw_classes.strip().strip('"\'')
        for token in normalize_classes(classes):
            if token:
                used.add(token.split(':')[0])

    for match in class_key_re.finditer(code_text):
        classes = match.group(2)
        if not classes:
            continue
        for token in normalize_classes(classes):
            if token:
                used.add(token)

    for match in js_class_method_re.finditer(code_text):
        fragment = match.group(0)
        for token in re.findall(r'"([^"]+)"|\'([^\']+)\'', fragment):
            token = token[0] or token[1]
            for t in normalize_classes(token):
                if t:
                    used.add(t)

    for match in query_selector_re.finditer(code_text):
        fragment = match.group(0)
        for token in re.findall(r'\.([A-Za-z_][A-Za-z0-9_:-]*)', fragment):
            used.add(token)

    for match in re.finditer(r'\.([A-Za-z_][A-Za-z0-9_-]*)', code_text):
        used.add(match.group(1))

    for match in concat_prefix_re.finditer(code_text):
        dynamic_prefixes.add(match.group(1))

    return used, dynamic_prefixes


def parse_css_classes():
    selectors = set()
    for css in CSS_FILES:
        text = comment_re.sub('', css.read_text(errors='ignore'))
        for block in text.split('{')[:-1]:
            head = block.strip()
            if not head:
                continue
            for part in head.split(','):
                for match in selector_re.finditer(part):
                    selector = match.group()[1:].split(':')[0].replace('::', '')
                    selectors.add(selector)
    return selectors


code_text = '\n'.join(
    p.read_text(errors='ignore')
    for p in CODE_FILES
    if '.git' not in p.parts
)

used_classes, dynamic_prefixes = parse_used_classes(code_text)
selectors = parse_css_classes()

possible_unused = []
for selector in sorted(selectors):
    if selector in IGNORE_SELECTORS or selector in RUNTIME_CLASSES:
        continue

    if any(selector.startswith(prefix) for prefix in dynamic_prefixes):
        continue

    if selector not in used_classes:
        possible_unused.append(selector)

print(f'Total selectors: {len(selectors)}')
print(f'Potentially dead selectors: {len(possible_unused)}')
for selector in possible_unused:
    print(selector)
