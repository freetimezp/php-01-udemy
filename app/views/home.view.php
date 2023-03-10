<?php

use \Model\User;
?>
<?php $this->view("includes/header", $data); ?>

<!-- ======= Header as nav ======= -->
<?php $this->view("includes/nav", $data); ?>

<!-- ======= Hero Slider Section ======= -->
<?php if (!empty($images)) : ?>
  <section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">

              <?php foreach ($images as $image) : ?>
                <div class="swiper-slide">
                  <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('<?= get_image($image->image); ?>');">
                    <div class="img-bg-inner">
                      <h2><?= esc($image->title); ?></h2>
                      <p><?= esc($image->description); ?></p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>

            </div>
            <div class="custom-swiper-button-next">
              <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
              <span class="bi-chevron-left"></span>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero Slider Section -->
<?php endif; ?>

<!-- ======= Post Grid Section ======= -->
<?php if (!empty($rows)) : ?>
  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2>Courses</h2>
        <div><a href="category.html" class="more">See All Courses</a></div>
      </div>

      <div class="row g-5">
        <div class="col-lg-4">
          <div class="post-entry-1 lg">
            <a href="single-post.html"><img src="<?= get_image($rows[0]->course_image); ?>" alt="" class="img-fluid" style="object-fit: cover;"></a>
            <div class="post-meta"><?= esc($rows[0]->category_row->category ?? 'unknown'); ?><span class="date"></span> <span class="mx-1">&bullet;</span> <span><?= get_date($rows[0]->date); ?></span></div>
            <h2><a href="single-post.html"><?= esc($rows[0]->title); ?></a></h2>
            <p class="mb-4 d-block"><?= esc($rows[0]->description); ?></p>

            <?php if (!empty($rows[0]->user_row)) : ?>
              <div class="d-flex align-items-center author">
                <div class="photo"><img src="<?= get_image($rows[0]->user_row->image); ?>" alt="" class="img-fluid" style="object-fit: cover;"></div>
                <div class="name">
                  <h3 class="m-0 p-0"><?= esc($rows[0]->user_row->name); ?></h3>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-lg-8">
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
<?php endif; ?>

<!-- ======= Culture Category Section ======= -->
<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Culture</h2>
      <div><a href="category.html" class="more">See All Culture</a></div>
    </div>

    <div class="row">
      <div class="col-md-9">

        <div class="d-lg-flex post-entry-2">
          <a href="single-post.html" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
            <img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-6.jpg" alt="" class="img-fluid">
          </a>
          <div>
            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
            <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
            <div class="d-flex align-items-center author">
              <div class="photo"><img src="<?= ROOT; ?>/zenblog/assets/img/person-2.jpg" alt="" class="img-fluid"></div>
              <div class="name">
                <h3 class="m-0 p-0">Wade Warren</h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="post-entry-1 border-bottom">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
              <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
            </div>

            <div class="post-entry-1">
              <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
              <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working Mom???s Guide</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Culture Category Section -->

<!-- ======= Business Category Section ======= -->
<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Business</h2>
      <div><a href="category.html" class="more">See All Business</a></div>
    </div>

    <div class="row">
      <div class="col-md-9 order-md-2">

        <div class="d-lg-flex post-entry-2">
          <a href="single-post.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
            <img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-3.jpg" alt="" class="img-fluid">
          </a>
          <div>
            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
            <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
            <div class="d-flex align-items-center author">
              <div class="photo"><img src="<?= ROOT; ?>/zenblog/assets/img/person-4.jpg" alt="" class="img-fluid"></div>
              <div class="name">
                <h3 class="m-0 p-0">Wade Warren</h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="post-entry-1 border-bottom">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
              <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
            </div>

            <div class="post-entry-1">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
              <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working Mom???s Guide</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Business Category Section -->

<!-- ======= Lifestyle Category Section ======= -->
<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Lifestyle</h2>
      <div><a href="category.html" class="more">See All Lifestyle</a></div>
    </div>

    <div class="row g-5">
      <div class="col-lg-4">
        <div class="post-entry-1 lg">
          <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
          <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
          <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>

          <div class="d-flex align-items-center author">
            <div class="photo"><img src="<?= ROOT; ?>/zenblog/assets/img/person-7.jpg" alt="" class="img-fluid"></div>
            <div class="name">
              <h3 class="m-0 p-0">Esther Howard</h3>
            </div>
          </div>
        </div>

        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

        <div class="post-entry-1">
          <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
          <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>

      </div>

      <div class="col-lg-8">
        <div class="row g-5">
          <div class="col-lg-4 border-start custom-border">
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-6.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2><a href="single-post.html">Let???s Get Back to Work, New York</a></h2>
            </div>
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 17th '22</span></div>
              <h2><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
            </div>
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-4.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Mar 15th '22</span></div>
              <h2><a href="single-post.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
            </div>
          </div>
          <div class="col-lg-4 border-start custom-border">
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-3.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2><a href="single-post.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
            </div>
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Mar 1st '22</span></div>
              <h2><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
            </div>
            <div class="post-entry-1">
              <a href="single-post.html"><img src="<?= ROOT; ?>/zenblog/assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
            </div>
          </div>
          <div class="col-lg-4">

            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working Mom???s Guide</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

          </div>
        </div>
      </div>

    </div> <!-- End .row -->
  </div>
</section><!-- End Lifestyle Category Section -->

<!-- ======= Footer ======= -->
<?php $this->view("includes/footer", $data); ?>