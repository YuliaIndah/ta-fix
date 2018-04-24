<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
<div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
<form class="form form-vertical" action="/avatar_upload.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-4 text-center">
            <div class="kv-avatar">
                <div class="file-loading">
                    <input id="avatar-2" name="avatar-2" type="file" required>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
                  <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email">Email Address<span class="kv-reqd">*</span></label>
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="pwd">Password<span class="kv-reqd">*</span></label>
                <input type="password" class="form-control" name="pwd" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" name="fname" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" name="lname" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <hr>
            <div class="text-right"> 
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
    </div>
</form>
 
<!-- the fileinput plugin initialization -->
<script>
var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
$("#avatar-2").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    showBrowse: false,
    browseOnZoneClick: true,
    removeLabel: '',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});
</script>
