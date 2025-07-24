<?php get_header() ?>
<div class="row">
    <div class="col-12 col-md-9">
        <div class="card">
            <div class="card-header d-flex flex-grow-1 align-items-center no-print">
                <p class="h4 m-0"><?php get_title() ?></p>
                <div class="right-button ms-auto">
                    <?php if($isPelaksana): ?>
                    <?php if($performance->status == 'BARU' || $performance->status == 'FEEDBACK'): ?>
                    <a href="/assessment/performances/do?id=<?=$performance->id?>&status=ON PROSES" class="btn btn-primary">Kerjakan</a>
                    <?php elseif($performance->status == 'ON PROSES'): ?>
                    <a href="/assessment/performances/do?id=<?=$performance->id?>&status=SELESAI" class="btn btn-primary">Selesai</a>
                    <?php endif ?>
                    <?php else: ?>
                    <?php if($performance->status == 'SELESAI'): ?>
                    <a href="/assessment/performances/do?id=<?=$performance->id?>&status=SEDANG EVALUASI" class="btn btn-primary">Evaluasi</a>
                    <?php elseif($performance->status == 'SEDANG EVALUASI'): ?>
                    <a href="/assessment/performances/do?id=<?=$performance->id?>&status=FEEDBACK" class="btn btn-primary">Feedback</a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Selesai Evaluasi</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Nilai Evaluasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/assessment/performances/finish" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="performance_id" value="<?=$performance->id?>">
                                    <div class="form-group">
                                        <label>Nilai</label>
                                        <input type="number" class="form-control" name="actual_value" max="100">
                                    </div>
                                    <p></p>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="card-body">
                <b>Parameter Standar</b><br>
                <?=$performance->sp_description?>
        
                <b>Indikator Capaian</b>
                <?=$performance->ti_description?>
        
                <b>Kinerja Tambahan</b>
                <?=$performance->description?>
                
                <b>Target Capaian</b><br>
                <p><?=$performance->actual_target?></p>
                
                <b>Pelaksana</b><br>
                <p><?=implode('<br>', array_column($pelaksana, 'nama_pelaksana'))?></p>
        
                <b>Status</b><br>
                <p><?=$performance->status?></p>
                
                <b>Nilai</b><br>
                <p><?=$performance->actual_value?></p>
            </div>
        </div>

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="true">Tanggapan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files" type="button" role="tab" aria-controls="files" aria-selected="false">Berkas</button>
            </li>
        </ul>

        <div class="tab-content">
            <div id="comments" class="tab-pane fade show active" role="tabpanel">
        
                <div class="card">
                    <div class="card-header">
                        <p class="h4">Tanggapan</p>
                    </div>
                    <div class="card-body">
                        <?php if(empty($comments)): ?>
                        <i>Tidak ada tanggapan</i>
                        <?php endif ?>
                        <?php foreach($comments as $comment): ?>
                        <div class="comment mb-3 bg-light p-3 rounded">
                            <b><?=$comment->commenter_name?></b> - <small><?=$comment->created_at?></small><br>
                            <p><?=$comment->content?></p>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <form action="<?=routeTo('assessment/performances/save-comment')?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="performance_id" value="<?=$_GET['id']?>">
                            <textarea name="content" id="" class="form-control" placeholder="Ketik komentar disini..." rows="8"></textarea>
                            <button class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

            <div id="files" class="tab-pane fade" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex flex-grow-1 align-items-center no-print">
                        <p class="h4">Berkas</p>
                        <div class="right-button ms-auto">
                            <button class="btn btn-primary" onclick="file.click()">Unggah Berkas</button>
                            <form action="/assessment/performances/upload" id="uploadFile" style="display:none" enctype="multipart/form-data" method="POST">
                                <?=csrf_field()?>
                                <input type="hidden" name="performance_id" value="<?=$_GET['id']?>">
                                <input type="file" name="file" id="file" style="opacity:0" onchange="document.querySelector('#uploadFile').submit()">
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(empty($files)): ?>
                        <i>Tidak ada berkas</i>
                        <?php endif ?>
                        <?php foreach($files as $file): ?>
                        <div class="mb-3 bg-light p-3 rounded">
                            <a href="<?=asset($file->file_url)?>" target="_blank"><?=$file->file_name?></a>
                            <br>
                            <?=date('d M Y H:i', strtotime($file->created_at))?>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-header">
                <p class="h4">Aktivitas</p>
            </div>
            <div class="card-body" style="max-height:500px;overflow:auto">
                <?php if(empty($logs)): ?>
                <i>Tidak ada aktivitas</i>
                <?php endif ?>
                <?php foreach($logs as $log): ?>
                <div class="comment mb-3 bg-light p-3 rounded">
                    <p><?=$log->description?></p>

                    <?=date('d M Y, H:i', strtotime($log->created_at))?>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
