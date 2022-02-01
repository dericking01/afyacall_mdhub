<div class="tab-pane active" id="drug-type">
    <!-- Responsive modal -->
    <table id="typeTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Patient Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Mobile</th>
            <th>Consultated at</th>
        </tr>
        </thead>
        <tbody>
            @foreach($doctor->patients as $key => $patient)
                <tr data-entry-id="{{ $patient->id }}">
                    <td>
                        {{ $patient->pat_no ?? '' }}
                    </td>
                
                    <td>
                        {{ $patient->firstname ?? '' }} 
                    </td>

                           
                    <td>
                        {{ $patient->lastname ?? '' }} 
                    </td>
                   
                    <td>
                        {{ $patient->gender ?? '' }} 
                    </td>

                    <td>
                        {{ $patient->phone ?? '' }} 
                    </td>

                    <td>
                        {{ $patient->created_at ?? '' }} 
                    </td>
                    

                </tr>
            @endforeach
        </tbody>

    </table>

</div>