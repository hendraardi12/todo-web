<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(config('app.name')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <div class="d-flex flex-row align-items-center flex-wrap">
            <div class="me-2"><h2>To Do List</h2></div>
            <div>Catat semua hal yang kamu kerjakan disini.</div>
        </div>
        <hr>
        <form action="/create" method="post">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="isi" class="form-control" placeholder="Kegiatan" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tgl_awal" class="form-control" placeholder="Tanggal Awal" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tgl_akhir" class="form-control" placeholder="Tanggal Awal" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </div>
        </form>
        <hr>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Awal</th>
                <th scope="col">Akhir</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($loop->iteration); ?></th>
                        <td><?php echo e($todo->isi); ?></td>
                        <td><?php echo e(date('d-m-Y',strtotime($todo->tgl_awal))); ?></td>
                        <td><?php echo e(date('d-m-Y',strtotime($todo->tgl_akhir))); ?></td>
                        <td><a href="/update-status/<?php echo e($todo->id); ?>/<?php echo e($todo->status == 0 ? 1 : 0); ?>" class="btn btn-sm btn-<?php echo e($todo->status == 0 ? 'warning' : 'success'); ?>"><?php echo e($todo->status); ?></a></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal">Ubah</button>
                            <a href="/delete/<?php echo e($todo->id); ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/update" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($todo->id); ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="isi" class="form-label">Kegiatan</label>
                                            <input type="text" name="isi" class="form-control" id="isi" value="<?php echo e($todo->isi); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" value="<?php echo e(date('Y-m-d',strtotime($todo->tgl_awal))); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_awal" class="form-label">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" value="<?php echo e(date('Y-m-d',strtotime($todo->tgl_akhir))); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="Belum" <?php if($todo->status == 0): ?> selected <?php endif; ?>>Belum</option>
                                                <option value="Sudah" <?php if($todo->status == 1): ?> selected <?php endif; ?>>Sudah</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>                                
                                </form>
                            </div>
                            </div>
                        </div>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html><?php /**PATH C:\laragon\www\todo-list\resources\views/todo.blade.php ENDPATH**/ ?>