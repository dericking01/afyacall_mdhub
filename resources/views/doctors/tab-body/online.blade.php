<div class="tab-pane active" id="print-setup">
        <div class="form-group row">
            <p></p>
            <label class="col-4 col-form-label" for="example-email">Doctor  {{$doctor->user['name']}} is ready to receive call</label>
            <div class="col-8">
                <input type="hidden" id="doctorname" name="doctorname" value={{$doctor->user['name']}}>
                <input type="hidden" id="doctorid" name="doctorid" value={{$doctor->user['id']}}>
                <input type="checkbox" name="adminchangestatus" id="adminchangestatus"  @if($doctor->user['status'] == 0) checked @endif />
            </div>
        </div>
       
</div>

