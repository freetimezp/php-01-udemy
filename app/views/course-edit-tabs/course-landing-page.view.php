<form>
    <div class="col-md-8 mx-auto">
        <div class="input-group my-3">
            <span class="input-group-text col-sm-2">Course Title</span>
            <input type="text" value="<?= $row->title; ?>" name="title" class="form-control col-sm-10" placeholder="Course title">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text col-sm-2">Course Subtitle</span>
            <input type="text" value="<?= $row->subtitle; ?>" name="subtitle" class="form-control col-sm-10" placeholder="Course subtitle">
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 ps-4">Course Description</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" style="height: 100px;"><?= $row->description; ?>          </textarea>
            </div>
        </div>

        <div class="d-flex flex-wrap">
            <div class="col-md-4 mb-3 p-1">
                <select class="form-select" name="language_id">
                    <option>--Select Language--</option>
                    <?php if (!empty($languages)) : ?>
                        <?php foreach ($languages as $lang) : ?>
                            <option <?= set_select('language_id', $lang->id, $row->language_id); ?> value="<?= $lang->id; ?>"><?= esc($lang->language); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3 p-1">
                <select class="form-select" name="level_id">
                    <option>--Select Level--</option>
                    <?php if (!empty($levels)) : ?>
                        <?php foreach ($levels as $level) : ?>
                            <option <?= set_select('level_id', $level->id, $row->level_id); ?> value="<?= $level->id; ?>"><?= esc($level->level); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3 p-1">
                <select class="form-select" name="category_id">
                    <option>--Select Category--</option>
                    <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $cat) : ?>
                            <option <?= set_select('category_id', $cat->id, $row->category_id); ?> value="<?= $cat->id; ?>"><?= esc($cat->category); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3 p-1">
                <select class="form-select" name="sub_category_id">
                    <option>--Select Subcategory--</option>
                </select>
            </div>
        </div>

        <label class="my-2 p-1">Pricing:</label>
        <div class="d-flex">
            <div class="col-md-4 mb-3 p-1">
                <select name="currency_id" class="form-select">
                    <option>--Select Currency--</option>
                    <?php if (!empty($currencies)) : ?>
                        <?php foreach ($currencies as $currency) : ?>
                            <option <?= set_select('currency_id', $currency->id, $row->currency_id); ?> value="<?= $currency->id; ?>"><?= esc($currency->currency . " ($currency->symbol)"); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3 p-1">
                <select name="price_id" class="form-select">
                    <option>--Select Price--</option>
                    <?php if (!empty($prices)) : ?>
                        <?php foreach ($prices as $price) : ?>
                            <option <?= set_select('price_id', $price->id, $row->price_id); ?> value="<?= $price->id; ?>"><?= esc($price->name . " (" . $price->price . ")"); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="input-group my-3">
            <span class="input-group-text col-sm-2">Primary Subject</span>
            <input type="text" value="<?= $row->primary_subject; ?>" name="primary_subject" class="form-control col-sm-10" placeholder="Primary Subject">
        </div>

        <div class="row my-4">
            <div class="col-sm-4">
                <img src="<?= ROOT; ?>/assets/images/no_image.jpg" alt="image" style="width: 100%;">
            </div>
            <div class="col-sm-8">
                <div class="h5">Course Image</div>
                Upload your Course Image here. Image must be jpg, jpeg, png or gif formats.<br><br>
                <input type="file">
                <div class="progress my-4">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-sm-4">
                <img src="<?= ROOT; ?>/assets/images/no_image.jpg" alt="image" style="width: 100%;">
            </div>
            <div class="col-sm-8">
                <div class="h5">Course Video</div>
                Upload your Course Video here.<br><br>
                <input type="file">
                <div class="progress my-4">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
            </div>
        </div>
    </div>
</form>