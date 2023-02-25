<?php

use \Model\User;
?>
<?php $this->view("includes/header", $data); ?>

<!-- ======= Header as nav ======= -->
<?php $this->view("includes/nav", $data); ?>

<!-- ======= Post Grid Section ======= -->
<?php if (!empty($rows)) : ?>
  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2>Courses on "<?=esc($rows[0]->category);?>" theme</h2>
      </div>

      <div class="row g-5">
        <div class="col-lg-12">
          <div class="row g-5">
            <div class="col-lg-8 border-start custom-border">
              <div class="row">
                <?php foreach ($rows as $row) : ?>
                  <div class="post-entry-1 col-lg-6">
                    <a href="single-post.html"><img src="<?= get_image($row->course_image); ?>" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date"><?= esc($row->category_row->category ?? 'unknown'); ?></span> <span class="mx-1">&bullet;</span> <span><?= get_date($row->date); ?></span></div>
                    <h2><a href="single-post.html"><?= esc($row->title); ?></a></h2>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Trending Section -->
            <div class="col-lg-4">

              <div class="trending">
                <h3>Trending</h3>
                <ul class="trending-post">
                  <?php if (!empty($trending)) : ?>
                    <?php $num = 0; ?>
                    <?php $user = new User(); ?>
                    <?php foreach ($trending as $row) : ?>
                      <?php $num++; ?>
                      <li>
                        <a href="single-post.html">
                          <span class="number"><?= $num; ?></span>
                          <h3><?= esc($row->title) ?></h3>
                          <span class="author">
                            <?php $author = $user->first(['id' => $row->user_id]); ?>
                            <?= $author->firstname . ' ' . $author->lastname; ?>
                          </span>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>

            </div> <!-- End Trending Section -->
          </div>
        </div>

      </div> <!-- End .row -->
    </div>
  </section> <!-- End Post Grid Section -->
<?php else: ?>
    <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2>Courses</h2>
        <div><a href="category.html" class="more">See All Courses</a></div>
      </div>

      <div class="row g-5">
        <div class="col-lg-12">
          <div class="row g-5">
            <div class="col-lg-8 border-start custom-border">
              No courses for category
            </div>

            <!-- Trending Section -->
            <div class="col-lg-4">

              <div class="trending">
                <h3>Trending</h3>
                <ul class="trending-post">
                  <?php if (!empty($trending)) : ?>
                    <?php $num = 0; ?>
                    <?php $user = new User(); ?>
                    <?php foreach ($trending as $row) : ?>
                      <?php $num++; ?>
                      <li>
                        <a href="single-post.html">
                          <span class="number"><?= $num; ?></span>
                          <h3><?= esc($row->title) ?></h3>
                          <span class="author">
                            <?php $author = $user->first(['id' => $row->user_id]); ?>
                            <?= $author->firstname . ' ' . $author->lastname; ?>
                          </span>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>

            </div> <!-- End Trending Section -->
          </div>
        </div>

      </div> <!-- End .row -->
    </div>
  </section> <!-- End Post Grid Section -->
<?php endif; ?>

<!-- ======= Footer ======= -->
<?php $this->view("includes/footer", $data); ?>