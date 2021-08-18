<div class="w-full sm:w-1/2 lg:w-1/4 bg-gray-900 h-screen-center-inner overflow-auto sidebar rounded sm:rounded-br-none sm:rounded-tr-none" x-data="{ activeTopicId: null }">
	<ul class="w-full flex flex-row sm:flex-col">
		@if (Auth::check())
		<li wire:key="new" class="flex text-yellow-300 bg-gray-900 group border-b border-gray-800">
			<a class="flex-1 block px-6 py-4 group-hover:bg-gray-800" href="{{ url('/new') }}">/new</a>
		</li>
		@endif
		@foreach ($topics as $topic)
		<li wire:key="{{ $topic->id }}" x-cloak @click="activeTopicId = {{ $topic->id }}" :class="`flex w-3/5 sm:w-full flex-shrink-0 flex-grow-0 text-purple-400 bg-gray-900 group border-b border-gray-800 ${(activeTopicId === {{ $topic->id }}) ? 'sidebar-active' : ''}`">
			<a wire:click.prevent="$emit('viewTopic', {{ $topic->id }})" href="{{ url('/post/' . $topic->id) }}" class="w-full max-w-full py-4 px-6 block group-hover:bg-gray-800">
				<h4 class="font-bold w-full break-all truncate">{{ $topic->title }}</h4>
				<p class="text-gray-600 leading-tight w-full break-all truncate">{{ $topic->posts->last()->excerpt(30) }}</p>
				<div class="text-sm mt-1 text-gray-700">Last: {{ '@' }}{{ $topic->last_user->name }}, {{ Carbon\Carbon::parse($topic->updated_at)->diffForHumans() }}</div>
			</a>
		</li>
		@endforeach
		@if ($haveMoreResults)
		<li wire:key="more" x-cloak class="flex text-yellow-300 bg-gray-900 group border-b border-gray-800">
			<a class="flex-1 block px-6 py-4 group-hover:bg-gray-800" wire:click.prevent="loadMore({{ $offset + 1 }})">More...</a>
		</li>
		@endif
	</ul>
</div>