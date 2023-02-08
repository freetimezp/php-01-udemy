<?php $this->view("admin/admin-header", $data); ?>

<?php if (message()) : ?>
    <div class="alert alert-success text-center">
        <?= message('', true); ?>
    </div>
<?php endif; ?>

<?php if ($action == 'add') : ?>
    <div class="card col-md-5 mx-auto">
        <div class="card-body">
            <h5 class="card-title">New Course</h5>

            <!-- No Labels Form -->
            <form method="POST" class="row g-3">
                <div class="col-md-12">
                    <input name="title" type="text" placeholder="Course title" value="<?= set_value('title') ?>" class="form-control <?= !empty($errors['title']) ? 'border-danger' : ''; ?>">

                    <?php if (!empty($errors['title'])) : ?>
                        <small class="text-danger"><?= $errors['title']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="col-md-12">
                    <select name="category_id" id="inputState" class="form-select <?= !empty($errors['category_id']) ? 'border-danger' : ''; ?>">
                        <option value="" selected>Course Category...</option>
                        <?php if (!empty($categories)) : ?>
                            <?php foreach ($categories as $cat) : ?>
                                <option <?= set_select('category_id', $cat->id); ?> value="<?= $cat->id; ?>"><?= esc($cat->category); ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <?php if (!empty($errors['category_id'])) : ?>
                        <small class="text-danger"><?= $errors['category_id']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>

                    <a href="<?= ROOT; ?>/admin/courses">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </a>
                </div>
            </form><!-- End No Labels Form -->

        </div>
    </div>
<?php elseif ($action == 'edit') : ?>

<?php else : ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                My Courses
                <a href="<?= ROOT; ?>/admin/courses/add">
                    <button class="btn btn-sm btn-primary float-end">
                        <i class="bi bi-camera-video-fill"></i> New Course
                    </button>
                </a>
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Primary Subject</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($rows)) : ?>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <th scope="row"><?=$row->id;?></th>
                                <td><?=esc($row->title);?></td>
                                <td><?=esc($row->user_row->name ?? 'Unknown');?></td>
                                <td><?=esc($row->category_row->category ?? 'Unknown');?></td>
                                <td><?=esc($row->price_id);?></td>
                                <td><?=esc($row->primary_subject);?></td>
                                <td><?=esc(get_date($row->date));?></td>
                                <td>
                                    <i class="bi bi-pencil-square"></i>
                                    <i class="bi bi-trash-fill"></i>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="text-danger py-5" colspan="10">
                                No courses yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>
<?php endif; ?>

<?php $this->view("admin/admin-footer", $data); ?>