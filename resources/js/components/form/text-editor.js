import {
    ClassicEditor,
    Essentials,
    Bold,
    Italic,
    Font,
    Paragraph,
    Heading,
    Image,
    ImageInsert,
    ImageTextAlternative,
    ImageCaption,
    Base64UploadAdapter,
    ImageResize,
    ImageToolbar,
    List,
    Alignment,
    Link,
    AutoLink
} from 'ckeditor5';

for (const [editorName, configuration] of Object.entries(window.editorConfiguration ?? {})) {
    ClassicEditor
        .create(document.getElementById(`${editorName}-text-editor`), {
            licenseKey: 'GPL',
            plugins: [
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph,
                Heading,
                Image,
                ImageInsert,
                ImageTextAlternative,
                Base64UploadAdapter,
                ImageResize,
                ImageCaption,
                ImageToolbar,
                List,
                Alignment,
                Link,
                AutoLink
            ],
            toolbar: [
                ...configuration
            ],
            image: {
                toolbar: [ 'toggleImageCaption', 'imageTextAlternative' ]
            }
        })
        .then((instance) => {
            if (instance?.ui?.element) {
                instance.ui.element.classList.add('flex-1');
                instance.ui.element.classList.add('ckeditor5');
            }
        });
}

