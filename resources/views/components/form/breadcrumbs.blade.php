@if ($breadcrumbs)
<div style="background-color: #345C8C; width: 100%">
    <div class="container">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $label => $link)
                <li>{!!  $link ? '<a href="' . $link . '">' : '' !!}{!! $label !!}{!! $link ? '</a>' : ''  !!}</li>
            @endforeach
        </ol>
    </div>
</div>
@endif