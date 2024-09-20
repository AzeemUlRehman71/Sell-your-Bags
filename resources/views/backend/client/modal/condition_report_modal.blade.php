<div class="modal fade" id="condition-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
             
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="condition-report-title">Condition Report</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0.8rem 2rem;">
                   <ul class="nav nav-tabs condition-report" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="first-inspection-tab" data-identifier="first-inspection" data-bs-toggle="tab" data-bs-target="#first-inspection" type="button" role="tab" aria-controls="first-inspection" aria-selected="true">Customer Inspection</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="second-inspection-tab" data-identifier="second-inspection" data-bs-toggle="tab" data-bs-target="#second-inspection" type="button" role="tab" aria-controls="second-inspection" aria-selected="false">Incoming Inspection</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="third-inspection-tab" data-identifier="third-inspection" data-bs-toggle="tab" data-bs-target="#third-inspection" type="button" role="tab" aria-controls="third-inspection" aria-selected="false">Listing Inspection</button>
                      </li>
                  </ul>
                  <div class="tab-content condition-report" id="myTabContent">
                      <div class="tab-pane fade show active" id="first-inspection" role="tabpanel" aria-labelledby="first-inspection-tab">
                        <div class="row" id="first-inspection-container" style="max-height: 350px; overflow-y: auto; padding-left: 20px;">
                           {{--@include('backend.client.modal._form_condition_report', ['title' => 'Customer Inspection', 'formId' =>'first-inspection', 'inspectionType' => 'first-inspection'])--}}
                        </div>
                      </div>
                      <div class="tab-pane fade" id="second-inspection" role="tabpanel" aria-labelledby="second-inspection-tab">
                        <div class="row" id="second-inspection-container" style="max-height: 350px; overflow-y: auto; padding-left: 20px;">
                           {{--@include('backend.client.modal._form_condition_report', ['title' => 'Incoming Inspection', 'formId' =>'second-inspection', 'inspectionType' => 'second-inspection'])--}}
                        </div>
                      </div>
                      <div class="tab-pane fade" id="third-inspection" role="tabpanel" aria-labelledby="third-inspection-tab">
                        <div class="row" id="third-inspection-container" style="max-height: 350px; overflow-y: auto; padding-left: 20px;">
                           {{--@include('backend.client.modal._form_condition_report', ['title' => 'Listing Inspection', 'formId' =>'third-inspection', 'inspectionType' => 'third-inspection'])--}}
                        </div>
                      </div>
                  </div>


                    <div class="row" style="display: none; max-height: 400px; overflow-y: auto;" id="comparison-report">

                    </div>
 
                   
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="button" style="display: none;" id="condition-report-btn" onclick="showConditionReport()">Condition Report</button>
                    <button class="btn btn-info" type="button" id="comparison-report-btn" onclick="fetchComparisonReport()">Comparison Report</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit" id="condition-form-save">Save</button>
                </div>
             <form>
        </div>
    </div>
 </div>