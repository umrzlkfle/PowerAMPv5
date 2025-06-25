@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center py-6">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 w-full max-w-4xl relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500 z-10"></div>
            <div class="absolute -top-10 -right-10 w-20 h-20 rounded-full bg-blue-100 blur-xl"></div>
            <div class="absolute -bottom-10 -left-10 w-24 h-24 rounded-full bg-indigo-100 blur-xl"></div>
            
            {{-- Pagination Info --}}
            <div class="text-center mb-6">
                <p class="text-sm text-gray-600 font-medium">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-bold text-blue-600">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-bold text-blue-600">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-bold text-blue-600">{{ $paginator->count() }}</span>
                    @endif
                    {!! __('of') !!}
                    <span class="font-bold text-blue-600">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            {{-- Mobile Pagination --}}
            <div class="flex justify-between sm:hidden mb-6">
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed rounded-lg transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 border-0 rounded-lg hover:from-blue-600 hover:to-indigo-700 hover:-translate-y-0.5 hover:shadow-md transition-all duration-300 group overflow-hidden">
                        <svg class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {!! __('pagination.previous') !!}
                    </a>
                @endif

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 border-0 rounded-lg hover:from-blue-600 hover:to-indigo-700 hover:-translate-y-0.5 hover:shadow-md transition-all duration-300 group overflow-hidden">
                        {!! __('pagination.next') !!}
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed rounded-lg transition-all duration-300">
                        {!! __('pagination.next') !!}
                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </div>

            {{-- Desktop Pagination --}}
            <div class="hidden sm:flex sm:items-center sm:justify-center">
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-lg overflow-hidden">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-4 py-3 text-sm font-semibold text-gray-400 bg-gray-50 border-r border-gray-200 cursor-not-allowed transition-all duration-300" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 hover:-translate-y-0.5 hover:shadow-md transition-all duration-300" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-3 text-sm font-bold text-gray-400 bg-white border-r border-gray-200 cursor-default select-none">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-3 text-sm font-bold text-white bg-gradient-to-r from-blue-500 to-indigo-600 border-r border-blue-400 cursor-default shadow-md transform scale-105 z-10">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-3 text-sm font-semibold text-gray-700 bg-white border-r border-gray-200 hover:bg-gray-50 hover:text-blue-600 hover:-translate-y-0.5 hover:shadow-sm transition-all duration-300" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 hover:-translate-y-0.5 hover:shadow-md transition-all duration-300" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-4 py-3 text-sm font-semibold text-gray-400 bg-gray-50 cursor-not-allowed transition-all duration-300" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>

            {{-- Quick Jump Section --}}
            <div class="flex flex-wrap items-center justify-center gap-3 mt-6 pt-6 border-t border-gray-200">
                <span class="text-sm text-gray-600 font-medium">Quick jump:</span>
                @if ($paginator->currentPage() > 3)
                    <a href="{{ $paginator->url(1) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:scale-105 transition-all duration-300">
                        First
                    </a>
                @endif
                
                @if ($paginator->hasMorePages() && $paginator->currentPage() < $paginator->lastPage() - 2)
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:scale-105 transition-all duration-300">
                        Last ({{ $paginator->lastPage() }})
                    </a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Custom CSS for animations --}}
    <style>
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
@endif