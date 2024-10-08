@extends('user-account.layout.app')
@section('content')
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-top:0; 
        margin-bottom:0; 
    }
    h1 {
        color: #000000;
        /* text-align: center; */
        font-weight: 100;
    }
    .filter-section {
        margin-bottom: 20px;
    }
    .search-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }
    .filter-button {
        padding: 8px 16px;
        border: 1px solid #007bff;
        border-radius: 4px;
        background: white;
        color: #007bff;
        cursor: pointer;
        transition: all 0.3s;
    }
    .filter-button.active {
        background: #007bff;
        color: white;
    }
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .book-card {
        background: transparent;
        perspective: 1000px;
        height: 400px;
    }
    .book-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }
    .book-card:hover .book-card-inner {
        transform: rotateY(180deg);
    }
    .book-card-front, .book-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .book-card-front {
        background: white;
    }
    .book-card-back {
        background: #f8f9fa;
        transform: rotateY(180deg);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
    }
    .book-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .book-info {
        padding: 15px;
    }
    .book-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }
    .book-author {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }
    .book-category {
        font-size: 14px;
        color: #007bff;
        margin-bottom: 10px;
    }
    .book-price {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }
    .price-old {
        text-decoration: line-through;
        color: #999;
        margin-right: 10px;
    }
    .price-new {
        font-weight: 600;
        color: #28a745;
        font-size: 18px;
    }
    .btn-learn-more {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        font-weight: bold;
    }
    .btn-learn-more:hover {
        background-color: #0056b3;
    }
    .book-description {
        font-size: 14px;
        color: #333;
        margin-bottom: 15px;
        line-height: 1.6;
    }
</style>
@endpush

<div class="card mt-4">
    <div class="card-title"></div>
    <div class="card-body">
        <p class="mb-4" style="font-weight: 100; font-size:35px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Our Books </p>

        <div class="filter-section">
            <input 
                type="text" 
                id="searchInput"
                placeholder="Search books by title, author, or course..." 
                class="search-input"
            >

            <div class="filter-buttons">
                <button 
                    type="button" 
                    data-category="all" 
                    class="filter-button active">All Books</button>
                @foreach($courses as $course)
                <button 
                    type="button" 
                    data-category="{{ $course->course_name }}" 
                    class="filter-button">
                    {{ $course->course_name }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="book-grid" id="bookGrid">
            @forelse($books as $book)
            <div class="book-card" data-category="{{ $book->videocourse->course_name ?? 'Uncategorized' }}">
                <div class="book-card-inner">
                    <div class="book-card-front">
                        <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="book-image">
                        <div class="book-info">
                            <h3 class="book-title">{{ $book->title }}</h3>
                            <p class="book-author">By: {{ $book->author }}</p>
                            <p class="book-category">{{ $book->videocourse->course_name ?? 'Uncategorized' }}</p>
                            <div class="book-price">
                                @if($book->is_paid)
                                    <span class="price-old">${{ $book->price }}</span>
                                    <span class="price-new">${{ $book->discount_price }}</span>
                                @else
                                    <span class="price-new">Free</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="book-card-back">
                        <h3 class="book-title">{{ $book->title }}</h3>
                        <p class="book-description">{{ Str::limit($book->description, 150) }}</p>
                        <div class="book-price">
                            @if($book->is_paid)
                                <span class="price-old">${{ $book->price }}</span>
                                <span class="price-new">${{ $book->discount_price }}</span>
                            @else
                                <span class="price-new">Free</span>
                            @endif
                        </div>
                        <a href="{{ url('/books/' . $book->id) }}" class="btn-learn-more">
                            <i class="fas fa-info-circle me-2"></i>More Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-4">
                <h3>No books found</h3>
                <p>Try adjusting your search or filter criteria</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-button');
        const searchInput = document.getElementById('searchInput');
        const bookGrid = document.getElementById('bookGrid');
        const bookCards = document.querySelectorAll('.book-card');

        function filterBooks() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeCategory = document.querySelector('.filter-button.active').dataset.category;

            bookCards.forEach(card => {
                const title = card.querySelector('.book-title').textContent.toLowerCase();
                const author = card.querySelector('.book-author').textContent.toLowerCase();
                const category = card.dataset.category.toLowerCase();
                const matchesSearch = title.includes(searchTerm) || author.includes(searchTerm) || category.includes(searchTerm);
                const matchesCategory = activeCategory === 'all' || category === activeCategory.toLowerCase();

                card.style.display = matchesSearch && matchesCategory ? 'block' : 'none';
            });
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                filterBooks();
            });
        });

        searchInput.addEventListener('input', filterBooks);

        // Initial filter
        filterBooks();
    });
</script>
@endpush

@include('user-account.content.footer')
@endsection