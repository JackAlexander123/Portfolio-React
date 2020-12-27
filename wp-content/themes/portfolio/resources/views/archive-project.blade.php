@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  <form action="">
    <div class="container">
      <div class="row">
        @foreach($search_terms as $term)
          <div class="col">
            <h4>{!! esc_html($term['title']) !!}</h4>
            <select name="term_{{ $term['tax'] }}" id="{{ $term['tax'] }}" onchange="this.form.submit()">
              <option value="*">All</option>
              @foreach($term['terms'] as $single_term)
                <option value="{{ $single_term->term_id }}" {{ $_GET['term_'.$term['tax']] == $single_term->term_id ? ' selected' : '' }}>{!! esc_html($single_term->name) !!} ({{ $single_term->count }})</option>
              @endforeach
            </select>
          </div>
        @endforeach
      </div>
    </div>
  </form>

  <div class="container">
    <div class="row">
      @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type(), \App\Controllers\ArchiveProject::getProjectData(get_the_ID()))
      @endwhile
    </div>
  </div>

  {!! get_the_posts_navigation() !!}
@endsection
