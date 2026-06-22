@if ($paginator->hasPages())
    <div style="display: flex; align-items: center; gap: 6px; justify-content: center; margin-top: 16px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="display: inline-flex; align-items: center; padding: 4px 8px; font-size: 11px; color: #999; background: #f0f0f0; border: 1px solid #ddd; border-radius: 4px; cursor: not-allowed;">
                ← Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="display: inline-flex; align-items: center; padding: 4px 8px; font-size: 11px; color: var(--accent); background: var(--surface); border: 1px solid var(--border); border-radius: 4px; text-decoration: none; cursor: pointer; transition: all 0.2s;">
                ← Prev
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="display: inline-flex; align-items: center; padding: 4px 6px; font-size: 11px; color: var(--muted);">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="display: inline-flex; align-items: center; padding: 4px 8px; font-size: 11px; font-weight: 600; color: #fff; background: var(--accent); border: 1px solid var(--accent); border-radius: 4px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display: inline-flex; align-items: center; padding: 4px 8px; font-size: 11px; color: var(--accent); background: var(--surface); border: 1px solid var(--border); border-radius: 4px; text-decoration: none; cursor: pointer; transition: all 0.2s;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="display: inline-flex; align-items: center; padding: 4px 8px; font-size: 11px; color: var(--accent); background: var(--surface); border: 1px solid var(--border); border-radius: 4px; text-decoration: none; cursor: pointer; transition: all 0.2s;">
                Next →
            </a>
        @else
            <span style="display: inline-flex; align-items: center; padding: 4px 8px; font-size: 11px; color: #999; background: #f0f0f0; border: 1px solid #ddd; border-radius: 4px; cursor: not-allowed;">
                Next →
            </span>
        @endif
    </div>
@endif
