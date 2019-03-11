@section('scripts')

    <script src="{{asset('js/dropzone.js')}}"></script>
    <script>

            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 32, // MB
                maxFiles: 20,
                dictFileSizeUnits: "kb",
                dictRemoveFile: 'Quitar archivo',
                dictFileTooBig: 'Archivo demasiado grande: 32MB',
                timeout: 60000,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                parallelUploads: 20,
                success: function (file, response) {
                    if (file.previewElement) {
                        file.Id = response.Id; // add programmatically to Dropzone.js
                        file.filename = response.filename; // add programmatically to Dropzone.js
                        return file.previewElement.classList.add("dz-success");
                    }
                },
                removedfile: function (file) {
                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                        $.get({
                            url: '/{{ $removeItem }}/' + file.Id,
                            dataType: 'json',
                            success: function (data) {
                                alert(data.mensaje);
                                file.previewElement.parentNode.removeChild(file.previewElement);
                            }
                        });
                    }
                    return this._updateMaxFilesReachedClass();
                },

            };


        // alert("hola");

    </script>

@endsection
