<div class="table-responsive">
    <table style="direction: ltr;" class="table table-bordered">
        <thead class="">
        <tr>
            <th style="width: 20%;"> Code</th>
            <th style="width: 50%;">Course Name</th>
            <th style="width: 30%;">Credit Hours</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->code }}</td>
                <td>{{ $course->title }}</td>
                <td>({{ $course->lecture_hours }},{{ $course->practical_hours }},{{ $course->clinical_hours }})</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
