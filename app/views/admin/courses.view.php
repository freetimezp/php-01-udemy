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
                    <big class="text-success "><?= esc($row->title); ?></big>
                </p>

                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="intended-learners-tab" data-bs-toggle="tab" data-bs-target="#intended-learners" type="button" role="tab" aria-controls="intended-learners" aria-selected="true"
                        onclick="set_tab(this.getAttribute('data-bs-target'))">
                            Intended Learners
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false"
                        onclick="set_tab(this.getAttribute('data-bs-target'))">
                            Curriculum
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="course-landing-page-tab" data-bs-toggle="tab" data-bs-target="#course-landing-page" type="button" role="tab" aria-controls="course-landing-page" aria-selected="false"
                        onclick="set_tab(this.getAttribute('data-bs-target'))">
                            Course landing page
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation-tab">
                        <button class="nav-link w-100" id="promotions" data-bs-toggle="tab" data-bs-target="#promotions" type="button" role="tab" aria-controls="promotions" aria-selected="false"
                        onclick="set_tab(this.getAttribute('data-bs-target'))">
                            Promotions
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation-tab">
                        <button class="nav-link w-100" id="course-messages" data-bs-toggle="tab" data-bs-target="#course-messages" type="button" role="tab" aria-controls="course-messages" aria-selected="false"
                        onclick="set_tab(this.getAttribute('data-bs-target'))">
                            Course messages
                        </button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade show active" id="intended-learners" role="tabpanel" aria-labelledby="intended-learners">
                        1
                    </div>
                    <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum">
                        2
                    </div>
                    <div class="tab-pane fade" id="course-landing-page" role="tabpanel" aria-labelledby="course-landing-page">
                        3
                    </div>
                    <div class="tab-pane fade" id="promotions" role="tabpanel" aria-labelledby="promotions">
                        4
                    </div>
                    <div class="tab-pane fade" id="course-messages" role="tabpanel" aria-labelledby="course-messages">
                        5
                    </div>
                </div><!-- End Bordered Tabs Justified -->

                <div class="text-center my-5">
                    <button class="btn btn-success">Save</button>

                    <a href="<?= ROOT; ?>/admin/courses">
                        <button class="btn btn-secondary">Back</button>
                    </a>
                </div>
            <?php else : ?>
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

<script>
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "#intended-learners";

    function show_tab(tab_name) {
        const someTabTriggerEl = document.querySelector(tab_name + "-tab");
        const tab = new bootstrap.Tab(someTabTriggerEl);
        tab.show();
    }

    function set_tab(tab_name) {
        tab = tab_name;
        sessionStorage.setItem("tab", tab_name);
    }
</script>

<?php $this->view("admin/admin-footer", $data); ?>