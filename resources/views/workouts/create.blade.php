<div class="container">
    <h1>Registrar Entrenamiento</h1>
    <form method="POST" action="{{ route('workouts.store') }}">
        @csrf
        {{ $workoutExercises }}
        @foreach ($workoutExercises->exercises as $exercise)
            <h3>{{ $exercise->name . ' - Entre ' . $exercise->min_reps_desired . '/' . $exercise->max_reps_desired . ' repeticiones.' }}
            </h3>
            @for ($i = 1; $i <= $exercise->num_series; $i++)
                <div class="mb-3">

                    <label>{{ "Serie $i - Peso Usado" }}</label>
                    <input type="number" name="exercises[{{ $exercise->id }}][series][{{ $i }}][used_weight]"
                        class="form-control" required>
                    <label>{{ "Serie $i - Repeticiones" }}</label>
                    <input type="number" name="exercises[{{ $exercise->id }}][series][{{ $i }}][repetitions]"
                        class="form-control" required>
                </div>
            @endfor
        @endforeach

        <button type="submit" class="btn btn-primary">Registrar Entrenamiento</button>
    </form>
</div>
