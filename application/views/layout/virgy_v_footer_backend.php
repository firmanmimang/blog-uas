          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer bg-dark">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-<?= date('Y'); ?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
      placeholder: 'Isi content...',
      height: '300px',
      toolbar: [
        ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['para', ['ul', 'ol']],
        ['insert', ['link']],
        ['view', ['undo', 'redo', 'fullscreen', 'codeview']]
      ]
    })
  })
</script>

<script type="text/javascript">
  window.setTimeout(function(){
    $('.alert').fadeTo(500,0).slideUp(500,function(){
      $(this).remove();
    });
  },5000);
</script>
<script type="text/javascript">
  window.setTimeout(function(){
    $('.text-danger').fadeTo(500,0).slideUp(500,function(){
      $(this).remove();
    });
  },5000);
</script>
<script type="text/javascript">
  window.setTimeout(function(){
    $('.is-invalid').removeClass('is-invalid');
  },5000);
</script>


</body>
</html>
