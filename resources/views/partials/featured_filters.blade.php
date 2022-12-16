<div class="sidebar_section w-100" id="sidebar_section">
  <div class="row no-gutters">
    <div class="col-sm-12 no-gutters">
        @foreach($filters as  $key => $project)
@if($project->show_on_sidebar == true)

        <div id="accordion{{$key}}" class="accordion">
            <div class="card  no-borders">
                <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseFilters{{$key}}">
                    <a class="card-title mayus">
                        {{removeCaps($project['nombrecategoria']) }}
                    </a>
                </div>

                <div id="collapseFilters{{$key}}" class="card-body collapse pl-0 pr-0 {{!empty($ids2)  ? 'show':null}} scrollable mCustomScrollbar" data-parent="#accordion{{$key}}" >
                   <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">

                    @foreach($project->categories($ids2) as $category)
                    <li>
                        <a  href="{{route('store.search', ['search' =>$category->nombrecategoria , 'strict' => true ])}}" class="no-decoration text-capitalize">{{$category->nombrecategoria}}</a>
                  </li>

                  @endforeach
              </ul>
          </div>
      </div>
  </div>
@endif
  
  @endforeach

</div>
</div>
</div>
{{--
<span class="badge badge-light"> {{$category->product_total($ids2)->count()}}</span>

--}}
