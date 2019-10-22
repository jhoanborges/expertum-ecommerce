<div class="col-lg-12 mb-4">
    <div id="accordion{{$key}}" class="accordion">
        <div class="card  no-borders">
            <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseTwo{{$key}}">
                <a class="card-title mayus">
                    {{removeCaps($project['nombrecategoria']) }}
                </a>
            </div>
            <div id="collapseTwo{{$key}}" class="card-body collapse pl-0 pr-0" data-parent="#accordion{{$key}}" >
                @foreach($project->categories($ids2) as $category)

                <div class="checkbox pmd-default-theme mt-3">
                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                        <input type="checkbox" value="">
                        <span>{{$category->nombrecategoria}}</span>
                    </label>
                    <span class="badge badge-light"> {{$category->product_total($ids2)->count()}}</span>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
