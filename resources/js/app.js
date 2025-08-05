import initCodeMirror from './codemirroreditor';

document.addEventListener('DOMContentLoaded', () => {
    initCodeMirror();
});

document.addEventListener('livewire:load', () => {
    window.Livewire.hook('message.processed', () => {
        initCodeMirror(); // re-initialize if Livewire rerenders
    });
});
