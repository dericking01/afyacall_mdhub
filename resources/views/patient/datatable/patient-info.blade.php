<b>{{$patient->firstname}}</b>  <b>{{$patient->lastname}}</b><br>
Gender : @if($patient->gender == 'Male')
    Male
@elseif($patient->gender == 'Female')
    FeMale
@else
    Other
@endif
<br>
Age : {{$patient->date_of_birth}} <br>

<b>Patient Number : {{$patient->pat_no}}</b> <br>

<a href="javascript:void(0);" onclick="window.location.replace('{{url('admin/consultation/consulte-patient-now/'.$patient->id)}}')"><i class="ti ti-ink-pen"></i> New Consultation </a>
