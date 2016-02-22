<div class="form-group row">
    <label for="active" class="col-sm-2 form-control-label">Active</label>
    <div class="col-sm-4">
        <input type="checkbox" name="active" class="form-control" id="active" checked value="1">
    </div>
    <label for="publish_at" class="col-sm-2 form-control-label">Publish At</label>
    <div class="col-sm-4">
        <input type="input" name="publish_at" class="form-control" id="publish_at" value="{{ date('Y/m/d H:i:s') }}">
    </div>
</div>
<div class="form-group row">
    <label for="title" class="col-sm-2 form-control-label">Title</label>
    <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" placeholder="title">
    </div>
</div>
<div class="form-group row">
    <label for="slug" class="col-sm-2 form-control-label">Your vanity URL</label>
    <div class="input-group col-sm-10">
        <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>
</div>
<div class="form-group row">
    <label for="active" class="col-sm-12 form-control-label">Body</label>
    <div class="col-sm-12">
        <textarea class="col-sm-12" id="content" name="body" rows="50">
        </textarea>
    </div>
</div>





