<?php $this->view("admin/admin-header", $data); ?>

<div class="pagetitle">
  <h1>Slider Images</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Admin</li>
      <li class="breadcrumb-item">Slider Images</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-12">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" onclick="set_tab(this.getAttribute('data-bs-target'))" id="profile-overview-tab">
                Slider 1
              </button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" onclick="set_tab(this.getAttribute('data-bs-target'))" id="profile-edit-tab">
                Slider 2
              </button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" onclick="set_tab(this.getAttribute('data-bs-target'))" id="profile-settings-tab">
                Slider 3
              </button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" onclick="set_tab(this.getAttribute('data-bs-target'))" id="profile-change-password-tab">
                Slider 4
              </button>
            </li>

          </ul>
          <!-- Form -->
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Slider 1</h5>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Slider Image</label>
                  <div class="col-md-8 col-lg-9">

                    <div class="d-flex flex-column">
                      <img src="<?= get_image($rows[0]->image ?? ''); ?>" style="width:80%; min-width:80%; max-width:80%; height:400px; min-height:400px; max-height:400px;" alt="Profile" class="js-image-preview">
                      <div class="js-filename m-2">Selected File: None</div>
                    </div>

                    <div class="pt-2">
                      <label class="btn btn-primary btn-sm" title="Upload new profile image">
                        <i class="bi bi-upload text-white"></i>
                        <input onchange="load_image(this.files[0])" type="file" class="js-profile-image-input" name="image" style="display: none;">
                      </label>

                      <?php if (!empty($errors['image'])) : ?>
                        <small class="js-error-image text-danger"><?= $errors['image']; ?></small>
                      <?php endif; ?>
                      <small class="js-error-image text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="title" class="col-md-4 col-lg-3 col-form-label">Slider Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title" type="text" class="form-control" id="title" required value="<?= set_value('title', $rows[0]->title ?? ''); ?>">
                  </div>

                  <?php if (!empty($errors['title'])) : ?>
                    <small class="js-error-title text-danger"><?= $errors['title']; ?></small>
                  <?php endif; ?>
                  <small class="js-error-title text-danger"></small>
                </div>

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">Slider Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description" class="form-control" id="description" style="height: 100px"><?= set_value('description', $rows[0]->description ?? ''); ?></textarea>
                  </div>

                  <?php if (!empty($errors['description'])) : ?>
                    <small class="js-error-description text-danger"><?= $errors['description']; ?></small>
                  <?php endif; ?>
                  <small class="js-error-description text-danger"></small>
                </div>

                <div class="js-prog progress my-4 hide">
                  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    Saving.. 50%
                  </div>
                </div>


                <div class="text-center">
                  <a href="<?= ROOT; ?>/admin">
                    <button type="button" class="btn btn-secondary">Back</button>
                  </a>
                  <button type="button" onclick="save_image(event, 2)" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Form -->
            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">
              3
            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              4
            </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "#profile-overview";
  var uploading = false;

  function show_tab(tab_name) {
    const someTabTriggerEl = document.querySelector(tab_name + "-tab");
    const tab = new bootstrap.Tab(someTabTriggerEl);
    //console.log(tab);

    tab.show();
  }

  function set_tab(tab_name) {
    tab = tab_name;
    //console.log(tab);
    sessionStorage.setItem("tab", tab_name);
  }

  function load_image(file) {
    document.querySelector(".js-filename").innerHTML = "Selected File: " + file.name;

    let mylink = window.URL.createObjectURL(file);

    document.querySelector(".js-image-preview").src = mylink;
  }

  window.onload = function() {
    show_tab(tab);
    //console.log(tab);
  }


  //upload functions
  function save_image(e, id) {
    if(uploading) {
      alert("Please wait another image is uploading");
      return;
    }

    uploading = true;

    //get form by click button
    var form = e.currentTarget.form;
    var inputs = form.querySelectorAll("input, textarea");
    var obj = {};
    var image_added = false;

    for (var i = 0; i < inputs.length; i++) {
      var key = inputs[i].name;

      if (key == 'image') {
        if (typeof inputs[i].files[0] == 'object') {
          obj[key] = inputs[i].files[0];
          image_added = true;
        }
      } else {
        obj[key] = inputs[i].value;
      }
    }

    obj.id = id;

    //validate image
    if (image_added) {
      var allowed = ['jpg', 'jpeg', 'png', 'gif'];

      if (typeof obj.image == 'object') {
        var ext = obj.image.name.split(".").pop();
      }

      if (!allowed.includes(ext.toLowerCase())) {
        alert("File type not allowed, try: " + allowed.toString(","));
        return;
      }
    }else{
      alert("Image is required!");
      return;
    }

    send_data(obj);
  }

  function send_data(obj, progbar = 'js-prog') {
    var prog = document.querySelector("." + progbar);
    prog.children[0].style.width = "0%";

    prog.classList.remove("hide");

    var myform = new FormData();

    for (key in obj) {
      myform.append(key, obj[key]);
    }

    var ajax = new XMLHttpRequest();
    ajax.addEventListener("readystatechange", function() {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          //everything well
          uploading = false;
          handle_result(ajax.responseText);
        } else {
          //server return error
          alert("error");
        }
      }
    });
    ajax.upload.addEventListener('progress', function(e) {
      var persent = Math.round((e.loaded / e.total) * 100);
      prog.children[0].style.width = persent + "%";
      prog.children[0].innerHTML = "Saving.." + persent + "%";
    });

    ajax.open('post', '', true);
    ajax.send(myform);
  }

  function handle_result(result) {
    //console.log(result);
    var obj = JSON.parse(result);

    if (typeof obj == 'object') {
      //create object

      if (typeof obj.errors == 'object') {
        //have errors
        display_errors(obj.errors);
        alert("Please fix errors");
      } else {
        //save complete
        alert(obj.message);
        window.location.reload();
      }
    }
  }

  function display_errors(errors) {
    for (key in errors) {
      if (document.querySelector(".js-error-" + key)) {
        var error = document.querySelector(".js-error-" + key).innerHTML = errors[key];
      }
    }
  }
</script>

<?php $this->view("admin/admin-footer", $data); ?>