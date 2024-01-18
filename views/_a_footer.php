
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col my-1">
                    <p class="m-0"
                    >FileManager CMS &#9829; implemented by Team <a href="https://twoandfrom.com/" target="_blank">Two & From</a></p
                    >
                </div>
            </div>
        </div>
    </footer>

    <!-- Modals -->
    <div class="modal fade" id="modalAddFolder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAddFolderLabel">Add folder</h1>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="needs-validation" novalidate>

                        <div class="form-group mb-3">
                            <label class="form-label" for="f_name">Nume folder</label>
                            <input type="text" class="form-control" name="f_name" id="f_name" placeholder="Nume folder" value="" required>
                            <div class="invalid-feedback">Please enter the name.</div>
                        </div>

                        <input type="hidden" name="parent_id" value="">
                        <input type="hidden" name="type" value="">
                        <input class="btn btn-primary" type="submit" name="folder_add" value="Adaugă">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRenameFolder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalRenameFolderLabel">Rename folder</h1>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="needs-validation" novalidate>

                        <div class="form-group mb-3">
                            <label class="form-label" for="f_name">Nume</label>
                            <input type="text" class="form-control" name="f_name" id="f_name" placeholder="Nume" value="" required>
                            <div class="invalid-feedback">Please enter the name.</div>
                        </div>

                        <input type="hidden" name="id_file" value="">
                        <input class="btn btn-primary" type="submit" name="file_rename" value="Modifică">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="waitModal" tabindex="-1" role="dialog" aria-labelledby="waitModallTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header text-center pt-5">
                    <img src="/images/loader.gif" alt="" class="" width="50">
                    <h2 class="modal-title w-100 font-weight-bold" id="waitModallTitle">Vă rugăm să aşteptaţi până când fişierul se va încărca!</h2>
                </div>

                <!--div class="modal-body px-5"></div-->

                <div class="modal-footer text-center">
                    <p class="w-100">
                        Veţi fi redirecţionat la sfârşitul operaţiunii.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="waitModalDownload" tabindex="-1" role="dialog" aria-labelledby="waitModalDownloadlTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center pt-5">
                    <img src="/images/loader.gif" alt="" class="" width="50">
                    <h2 class="modal-title w-100 font-weight-bold" id="waitModalDownloadlTitle">Vă rugăm să aşteptaţi până când se va genera arhiva şi se va termina de downloadat fişierul!</h2>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/admin_files/assets/js/plugins/popper.min.js"></script>
    <script src="/admin_files/assets/js/plugins/simplebar.min.js"></script>
    <script src="/admin_files/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/admin_files/assets/js/fonts/custom-font.js"></script>
    <script src="/admin_files/assets/js/pcoded.js"></script>
    <script src="/admin_files/assets/js/plugins/feather.min.js"></script>

    <?php if ($adminFunctions->dataTable): ?>
        <script src="/admin_files/assets/js/plugins/jquery.dataTables.min.js"></script>
        <script src="/admin_files/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
        <script src="/admin_files/assets/js/custom.dataTables.js?v=<?php echo $adminFunctions->version; ?>"></script>
    <?php endif ?>

    <?php if ($adminFunctions->tinyMce): ?>
        <script src="/admin_files/assets/js/plugins/tinymce/tinymce.min.js"></script>
        <script src="/admin_files/assets/js/custom.tinymce.js?v=<?php echo $adminFunctions->version; ?>"></script>
    <?php endif ?>

    <?php if ($adminFunctions->pageSel2): ?>
        <script src="/admin_files/assets/js/plugins/select2.min.js"></script>
        <script src="/admin_files/assets/js/custom.select2.js?v=<?php echo $adminFunctions->version; ?>"></script>
    <?php endif ?>

    <?php if ($adminFunctions->lightbox): ?>
        <script src="/admin_files/assets/js/plugins/lightbox.bundle.min.js"></script>
    <?php endif ?>

    <?php if ($adminFunctions->fileUploader): ?>
        <script src="/admin_files/assets/js/plugins/uppy.min.js"></script>
        <script>
          const Tus = Uppy.Tus;
          const DragDrop = Uppy.DragDrop;
          const ProgressBar = Uppy.ProgressBar;
          const StatusBar = Uppy.StatusBar;
          const FileInput = Uppy.FileInput;
          const Informer = Uppy.Informer;
          const Dashboard = Uppy.Dashboard;
          const Dropbox = Uppy.Dropbox;
          const GoogleDrive = Uppy.GoogleDrive;
          const Instagram = Uppy.Instagram;
          const Webcam = Uppy.Webcam;
          const XHRUpload = Uppy.XHRUpload;
          // Function for displaying uploaded files
          const onUploadSuccess = (elForUploadedFiles) => (file, response) => {
            const url = response.uploadURL;
            const fileName = file.name;

            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = url;
            a.target = '_blank';
            a.appendChild(document.createTextNode(fileName));
            li.appendChild(a);

            document.querySelector(elForUploadedFiles).appendChild(li);
          };
          (function () {
            var id = '#pc-uppy-1';
            var doc = document.getElementById("pc-uppy-1");
            var id_folder = doc.dataset.foderid;
            console.log('id_folder', id_folder);
            var url = 'https://www.filemanager.twoandfrom.com/upload.php?view=uppy_folder&id_folder=' + id_folder;
            var options = {
              proudlyDisplayPoweredByUppy: false,
              target: id,
              inline: true,
              replaceTargetContent: true,
              showProgressDetails: true,
              note: 'No filetype restrictions.',
              height: 470,
              metaFields: [
                {
                  id: 'name',
                  name: 'Name',
                  placeholder: 'file name'
                },
                {
                  id: 'caption',
                  name: 'Caption',
                  placeholder: 'describe what the image is about'
                }
              ],
              browserBackButtonClose: true
            };
            var uppyDashboard = Uppy.Core({
              autoProceed: true,
              restrictions: {
                maxFileSize: null, // 100000000
                maxNumberOfFiles: null,
                minNumberOfFiles: 1
              }
            });
            uppyDashboard.use(Dashboard, options);
            uppyDashboard.use(XHRUpload, { 
                endpoint: url, 
                fieldName: 'my_file', 
            });
            uppyDashboard.on('upload-success', onUploadSuccess('.pc-uppy-3 .uploaded-files ol'));
          })();
        </script>
    <?php endif ?>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener(
                'load',
                function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener(
                            'submit',
                            function (event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                                
                                if (form.checkValidity() !== false && form.classList.contains('formCuFisier')) {
                                    
                                    var myModal = new bootstrap.Modal(document.getElementById('waitModal'), {
                                        backdrop: 'static',
                                        keyboard: false
                                    });
                                    myModal.show();
                                }
                                
                                if (form.checkValidity() !== false && form.classList.contains('formCuDownloadFisier')) {
                                    
                                    var myModal = new bootstrap.Modal(document.getElementById('waitModalDownload'), {});
                                    myModal.show();
                                }
                            },
                            false
                        );
                    });
                },
                false
            );
        })();
    </script>
    <script>
        $(document).ready(function() {
            $(".tree-toggler").on('click', function(){
                $(this).toggleClass('noshow');
            });
            $(".listview-toggler").on('click', function(){
                console.log('click');
                $(".listview-toggler").removeClass('active');
                $(this).addClass('active');
                var target = $(this).data('target') // Extract info from data-* attributes
                var aclass = $(this).data('aclass') // Extract info from data-* attributes
                var rclass = $(this).data('rclass') // Extract info from data-* attributes
                $(target).removeClass(rclass);
                $(target).addClass(aclass);
            });

            $('#modalAddFolder').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var type = button.data('type') // Extract info from data-* attributes
                var title = button.data('title') // Extract info from data-* attributes
                var parent = button.data('parent') // Extract info from data-* attributes
                var modal = $(this)
                modal.find('.modal-title').text(title)
                modal.find('.modal-body input[name="parent_id"]').val(parent)
                modal.find('.modal-body input[name="type"]').val(type)
            });

            $('#modalRenameFolder').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var name = button.data('name') // Extract info from data-* attributes
                var title = button.data('title') // Extract info from data-* attributes
                var idfile = button.data('idfile') // Extract info from data-* attributes
                var modal = $(this)
                modal.find('.modal-title').text(title)
                modal.find('.modal-body input[name="f_name"]').val(name)
                modal.find('.modal-body input[name="id_file"]').val(idfile)
            });
            
            $(".multiple-dl-toggler").on('click', function(){
                $(this).toggleClass('active btn-primary btn-warning');
                $(".clearall").toggleClass('d-none');
                $(".dl-list .card.selectable").toggleClass('active');
                $('.dl-list [type="submit"]').toggleClass('d-none');
            });
            
            $(".clearall").on('click', function(){
                $('.dl-list [type="checkbox"]').prop('checked',false);
            });
            
            $(".card-file .favorite").on('click', function(){
                event.preventDefault();
                event.stopPropagation();
                var clickedButton = $(this);
                clickedButton.addClass('waiting');

                var idfile = clickedButton.data('idfile');
                var idusr = clickedButton.data('idusr');

                $.ajax({
                    type:'post',
                    url:'/ajax.php',
                    data:{
                        ajxfavfile: true,
                        idfile:idfile,
                        idusr:idusr
                    },
                    success:function(response) {
                        var responseObj = JSON.parse(response);
                        if(responseObj.success){
                            clickedButton.removeClass('waiting');
                            clickedButton.removeClass('text-warning');
                            clickedButton.removeClass('text-secondary');
                            clickedButton.addClass(responseObj.cls);
                        }else{
                            clickedButton.removeClass('waiting');
                            clickedButton.removeClass('text-warning');
                            clickedButton.removeClass('text-secondary');
                            clickedButton.addClass(responseObj.cls);
                        }

                    }
                });
            });
        });
    </script>
</body>
<!-- [Body] end -->

</html>