<div>
    <div class="container" style="padding: 30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add new Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}" class="btn btn-success pull-right">All Categories</a>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <form action="" class="form-horizontal">

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="" id="" placeholder="Category Name" class="form-control input-md" wire:model="name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                    <input type="text" name="" id="" placeholder="Category Slug" class="form-control input-md" wire:model="slug">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="" id="" placeholder="Category Name" class="form-control input-md">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
