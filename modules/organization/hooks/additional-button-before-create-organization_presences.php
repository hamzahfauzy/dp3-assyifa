<?php ob_start(); ?>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Form Upload</h5>
      </div>
      <div class="modal-body">
        <form action="<?=routeTo('organization/presences/import')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="" class="mb-2">Sample File</label><br>
                <a href="<?=asset('assets/organization/import-presences.xlsx')?>">Download</a>
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2">File</label>
                <input type="file" class="form-control" name="file">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
Import
</button>
<?php

return ob_get_clean();