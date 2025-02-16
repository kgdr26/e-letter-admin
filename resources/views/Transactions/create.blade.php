    @extends('main')
    @section('content')

        <section class="section dashboard">
            <div class="row align-items-top">
                <div class="card">
                    <div class="card-body">
                        <h1>Create Transaction for {{ $materai->name }}</h1>

                        @if ($errors->any())
                            <div style="color: red;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div style="color: red;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('transactions.store', $materai->id) }}" method="POST">
                            @csrf
                            <div>
                                <label for="type">Transaction Type:</label>
                                <select name="type" required>
                                    <option value="in">Return</option>
                                    <option value="out">Take</option>
                                </select>
                            </div>
                            <div>
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" required>
                            </div>
                            <button type="submit">Save</button>
                        </form>

                        <a href="{{ route('materais.index') }}">Back to List</a>
                    </div>
                </div>
            </div>
        </section>
    @stop
