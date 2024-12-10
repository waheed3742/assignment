@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($product->images as $index => $image)
                            <div class="carousel-item @if($index == 0) active @endif">
                                <img src="{{ asset('storage/'.$image->image_path) }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <h1 class="mb-3">{{ $product->name }}</h1>
                <p class="text-muted mb-4">{{ $product->description }}</p>
                <h4 class="text-primary">${{ number_format($product->price, 2) }}</h4>

                <div class="mt-3">
                    <h5>Categories:</h5>
                    <ul class="list-inline">
                        @foreach($product->categories as $category)
                            <li class="list-inline-item">
                                <span class="badge badge-info text-dark">{{ $category->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4">
                <h3>Comments</h3>
                    @foreach($product->comments as $comment)
                        <div class="comment">
                            <strong>{{ $comment->user->name }}:</strong>
                            <p>{{ $comment->comment }}</p>
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach

                    <form action="{{ route('product.storeComment', $product->slug) }}" method="POST">
                        @csrf
                        <textarea name="comment" class="form-control" rows="4" placeholder="Leave a comment"></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                    </form>
                </div>
                <div class="mt-4">
                    <h3>Feedback</h3>
                    @foreach($product->feedbacks as $feedback)
                        <div class="feedback">
                            <strong>{{ $feedback->user->name }}:</strong>
                            <p>Rating: 
                                <span class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star" 
                                              style="color: {{ $i <= $feedback->rating ? 'gold' : '#ddd' }};">&#9733;</span>
                                    @endfor
                                </span>
                                {{ $feedback->rating }} stars
                            </p>                            
                            <p>{{ $feedback->feedback }}</p>
                            <small>{{ $feedback->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach

                    <form action="{{ route('product.storeFeedback', $product->slug) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" class="star" required><label for="star5" class="star">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="4" class="star"><label for="star4" class="star">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3" class="star"><label for="star3" class="star">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="2" class="star"><label for="star2" class="star">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="1" class="star"><label for="star1" class="star">&#9733;</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea name="feedback" class="form-control" rows="4" placeholder="Leave your feedback"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
