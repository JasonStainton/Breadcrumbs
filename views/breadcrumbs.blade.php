@if(isset($breadcrumbs))

	@foreach($breadcrumbs as $url => $name)

		@if($url == url()->current())

			<span>{{ $name }}</span>

		@else

			<a href="{{ $url }}">{{ $name }}</a> &raquo;

		@endif

	@endforeach

@endif