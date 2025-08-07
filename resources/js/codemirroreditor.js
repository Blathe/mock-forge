import { EditorView, keymap, lineNumbers } from '@codemirror/view';
import { EditorState } from '@codemirror/state';
import { defaultKeymap } from '@codemirror/commands';
import { json } from '@codemirror/lang-json';
import { oneDark } from '@codemirror/theme-one-dark';
import { indentWithTab } from "@codemirror/commands"
import { foldGutter, codeFolding } from '@codemirror/language';
import { ayuLight, espresso } from 'thememirror';

export default function initCodeMirror() {
    console.log('Initializing codemirror editor.');
    const hidden = document.getElementById('json-editor-hidden');
    const container = document.getElementById('editor-container');

    if (!hidden || !container || window.__mockForgeEditor) return;

    let parsed = null;
    try {
        parsed = JSON.parse(hidden.value);
    } catch (e) {
        parsed = hidden.value; // fallback to raw input if invalid
    }

    //TODO: Clean this up and add theme stuff to it's own file.
    const lightTheme = espresso;
    const darkTheme = oneDark;

    let theme = espresso;

    //If no current theme, user is using System Defaults, flux.appearance is only set when explicitly choosing dark or light mode.
    const currentTheme = localStorage.getItem('flux.appearance');
    if(!currentTheme) {
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        if (prefersDarkScheme.matches) {
            theme = darkTheme;
        } else {
            theme = lightTheme;
        }
    } else {
        if (currentTheme === 'dark') {
            theme = darkTheme;
        } else {
            theme = lightTheme;
        }
    }

    const initialContent = typeof parsed === 'object'
        ? JSON.stringify(parsed, null, 2)
        : parsed;

    const state = EditorState.create({
        doc: initialContent,
        extensions: [
            keymap.of([defaultKeymap, indentWithTab]),
            json(),
            theme,
            lineNumbers(),
            foldGutter(),
            codeFolding(),
            EditorView.lineWrapping,
            EditorState.tabSize.of(2),
            EditorView.updateListener.of(update => {
                if (update.docChanged) {
                    const content = update.state.doc.toString();
                    hidden.value = content;
                    hidden.dispatchEvent(new Event('input'));
                }
            }),
        ]
    });

    const editor = new EditorView({
        state,
        parent: container
    });

    window.__mockForgeEditor = editor;

    const prettifyBtn = document.getElementById('prettify-btn');
    if (prettifyBtn) {
        prettifyBtn.addEventListener('click', () => {
            try {
                const raw = editor.state.doc.toString();
                const parsed = JSON.parse(raw);
                const pretty = JSON.stringify(parsed, null, 2);
                editor.dispatch({
                    changes: { from: 0, to: editor.state.doc.length, insert: pretty }
                });
                hidden.value = pretty;
                hidden.dispatchEvent(new Event('input'));
            } catch (e) {
                //TODO: Fix this later to a styled popup.
                alert('Invalid JSON. Cannot prettify.');
            }
        });
    }
}
