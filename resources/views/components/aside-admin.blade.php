 <aside class="col-2 main__section aside bg-white-border p-0" style="background: none">
      <nav class="aside__aside">
         <ul class="aside__list">
             @foreach ($items as $item)
                 <a href="{{ route($item['route']) }}" class="flex-and-direction-row flex-aligh-items-center">
                     <i class="{{ $item['icon'] }} fs-4 aside__list-icon text__gray"></i>
                     <li class="aside__list-item text__gray">{!! $item['title'] !!}</li>
                 </a>
             @endforeach
         </ul>
     </nav>
 </aside>
