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
                    <input name="primary_subject" type="text" value="<?= set_value('primary_subject') ?>" placeholder="Course primary subject e.g. Photography or Vlogging" class="form-control <?= !empty($errors['primary_subject']) ? 'border-danger' : ''; ?>">

                    <?php if (!empty($errors['title'])) : ?>
                        <small class="text-danger"><?= $errors['primary_subject']; ?></small>
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

    <div class="card">
        <div class="card-body">

            <?php if (!empty($row)) : ?>
                <p class="card-title">
                    Edit Course: 
                    <big class="text-success "><?=esc($row->title);?></big>
                </p>

                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                        Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                        Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                    </div>
                </div><!-- End Bordered Tabs Justified -->
                
                <div class="text-center my-5">
                    <button class="btn btn-success">Save</button>

                    <a href="<?=ROOT;?>/admin/courses">
                        <button class="btn btn-secondary">Back</button>
                    </a>
                </div>
            <?php else: ?>
                <div>That course was not found!</div>
            <?php endif; ?>

        </div>
    </div>

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
                                <th scope="row"><?= $row->id; ?></th>
                                <td><?= esc($row->title); ?></td>
                                <td><?= esc($row->user_row->name ?? 'Unknown'); ?></td>
                                <td><?= esc($row->category_row->category ?? 'Unknown'); ?></td>
                                <td><?= esc($row->price_row->name ?? 'Unknown'); ?></td>
                                <td><?= esc($row->primary_subject); ?></td>
                                <td><?= esc(get_date($row->date)); ?></td>
                                <td>
                                    <a href="<?= ROOT; ?>/admin/courses/edit/<?= $row->id; ?>">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </a>
                                    <a href="<?= ROOT; ?>/admin/courses/delete/<?= $row->id; ?>">
                                        <i class="bi bi-trash-fill text-danger"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php else : ?>
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