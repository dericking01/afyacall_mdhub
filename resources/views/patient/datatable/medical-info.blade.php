<p>
    Patient Science : {{$patient->created_at->format('d-M-Y')}} <br>
    Total Consultation's : {{count($patient->prescriptions)}} <br>
</p>

<a href="{{ route('admin.patient.medical.history',$patient->id) }}"><i class="fa fa-eye"></i> &nbsp; View Consultations History</a> <br>
<a href="#"><i class="fa fa-plus"></i> &nbsp; Add / view Representative </a>