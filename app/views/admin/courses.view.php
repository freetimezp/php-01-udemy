<?php $this->view("admin/admin-header", $data); ?>

<style>
    .tabs-holder {
        justify-content: center;
        align-items: center;
    }

    .my-tab {
        flex: 1;
        text-align: center;
        border-bottom: 2px solid #ccc;
        padding-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease-in;
    }

    .my-tab:hover {
        color: #4154F1;
    }

    .active-tab {
        color: #4154F1;
        border-color: #4154F1;
    }

    .hide {
        display: none;
    }
</style>

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
                <p class="card-title d-flex align-items-center">
                    <span>Edit Course: </span>
                    <span class="text-success mx-2"><?= esc($row->title); ?></span>
                </p>

                <!-- Tabs -->
                <div class="tabs-holder d-flex my-10">
                    <div id="intended-learners" class="my-tab active-tab" onclick="set_tab(this.id, this)">
                        Intended Learners
                    </div>
                    <div id="curriculum" class="my-tab" onclick="set_tab(this.id, this)">
                        Curriculum
                    </div>
                    <div id="course-landing-page" class="my-tab" onclick="set_tab(this.id, this)">
                        Course landing page
                    </div>
                    <div id="promotions" class="my-tab" onclick="set_tab(this.id, this)">
                        Promotions
                    </div>
                    <div id="course-messages" class="my-tab" onclick="set_tab(this.id, this)">
                        Course messages
                    </div>
                </div>
                <!-- End Tabs -->

                <!-- Tabs Body-->
                <div oninput="something_changed(event)">
                    <div class="div-tab" id="tabs-content">
                        1
                    </div>
                </div>
                <!-- End Tabs Body-->

                <div class="text-center my-5">
                    <button class="btn btn-success disabled js-save-button">Save</button>

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
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "intended-learners";
    var dirty = false;

    function show_tab(tab_name) {
        //change active tab
        var div = document.querySelector("#" + tab_name);
        var children = document.querySelectorAll(".my-tab");
        for (var i = 0; i < children.length; i++) {
            children[i].classList.remove("active-tab");
        }
        div.classList.add("active-tab");

        var content = tab_name + "<input />";
        document.querySelector("#tabs-content").innerHTML = content;

        disable_save_button(false);
    }

    function set_tab(tab_name) {
        if (dirty) {
            //ask user to save on switching tabs
            if (!confirm("Your changes were not saved, are you sure want to switch tab?")) {
               return;
            }
        }

        tab = tab_name;
        sessionStorage.setItem("tab", tab_name);
        dirty = false;
        show_tab(tab_name);
    }

    function something_changed(e) {
        dirty = tab;
        disable_save_button(true);
    }

    function disable_save_button(status = false) {
        if (status) {
            document.querySelector(".js-save-button").classList.remove("disabled");
        } else {
            document.querySelector(".js-save-button").classList.add("disabled");
        }
    }
</script>

<?php $this->view("admin/admin-footer", $data); ?>