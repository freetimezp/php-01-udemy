<form>
    <?php csrf(); ?>

    <div class="col-md-8 mx-auto mt-5">
        <div class="row mb-3">
            <label class="col-sm-2 ps-4">Welcome message</label>
            <div class="col-sm-10">
                <textarea name="welcome_message" class="form-control" style="height: 100px;"><?= $row->welcome_message; ?></textarea>
            </div>
            <small class="error error-welcome_message w-100 text-danger"></small>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 ps-4">Congratulations message</label>
            <div class="col-sm-10">
                <textarea name="congratulations_message" class="form-control" style="height: 100px;"><?= $row->congratulations_message; ?></textarea>
            </div>
            <small class="error error-congratulations_message w-100 text-danger"></small>
        </div>
    </div>
</form>