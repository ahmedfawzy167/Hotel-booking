import './bootstrap';


import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.css';
import 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.css';
import FilePond from 'filepond';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';



FilePond.registerPlugin(FilePondPluginFileValidateSize, FilePondPluginFileValidateType);
FilePond.setOptions({
    server: {
        url: '/upload', // Set the URL where you want to handle file uploads in Laravel
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
});
FilePond.parse(document.body);
