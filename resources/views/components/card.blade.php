 <!--begin::Mixed Widget 19-->
 <div {!! $attributes->merge(['class' => 'card']) !!}>
     <!--begin::Beader-->
     @if ($cardHeader)
         <div class="card-header">
             <h4>
                 @if ($title)
                     {{ $title }}
                 @endif
             </h4>
             <div class="card-header-action">
                 <!--begin::Menu-->
                 {{ $toolbar }}
                 <!--end::Menu-->
             </div>
         </div>
     @endif
     <!--end::Header-->

     <!--begin::Body-->
     <div class="card-body">
         {{ $slot }}
     </div>
     <!--end::Body-->
     @if ($cardFooter)
         <div class="card-footer text-right">
             {{ $cardFooter }}
         </div>
     @endif
 </div>
 <!--end::Mixed Widget 19-->
