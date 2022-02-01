<div>
    <div class="content-wrapper">
        <div class="content ">
            <h2 class="mb-3">{{ __('Course') }} Lorem ipsum dolor</h2>
            <h5 >{{ __('Instruction') }}</h5>
                <p  class=" w-100 mt-2">Lorem ipsum dolor sit amet, facer timeam cu mea, eu dicta tamquam sea, nec no doctus dolorem. Mandamus patrioque te duo. Nec case explicari constituto te. Impedit sensibus aliquando mel an, suas voluptaria referrentur duo no. Ad tritani veritus accommodare vis.</p> 
        </div>
    </div>
    <div class="accordion mt-3" id="questions" >
        <div class="accordion-item">
            <div class="accordion-header" id="headingOne">
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <h4>{{ __('What is the name of the figure?') }}</h4>
                            <button class="collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"  aria-controls="collapseOne">{{ __('Answers') }}</button> 
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <div class="img-wrapper">
                                <div class="wrapper"><img src=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h4>{{ __('Question 1') }}</h4>
                                <p class="value">8 {{ __('Points') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#questions">
                <div class="accordion-body p-0">
                    <div class="row m-0">
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <p class=" w-100">Curabitur ullamcorper ultricies nisi. </p>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <div class="img-wrapper">
                                    <div class="wrapper"><img src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h5>{{ __('Next') }}: {{ __('Question 2') }}</h5>
                                    <p class="value">{{ __('Value') }}: 8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 opt">
                <div class="box text-center d-flex align-items-center justify-content-center">
                    <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Last question') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked disabled>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Show in results') }}
                        </label>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" id="headingt">
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <h4>{{ __('What is the name of the figure?') }}</h4>
                            <button class="collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapset" aria-expanded="false"  aria-controls="collapset">{{ __('Answers') }}</button> 
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <div class="img-wrapper">
                                <div class="wrapper"><img src=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h4>{{ __('Question 2') }}</h4>
                                <p class="value">10 {{ __('Points') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapset" class="accordion-collapse collapse" aria-labelledby="headingt" data-bs-parent="#questions">
                <div class="accordion-body p-0">
                    <div class="row m-0">
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <p class=" w-100">Curabitur ullamcorper ultricies nisi. </p>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <div class="img-wrapper">
                                    <div class="wrapper"><img src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h5>{{ __('Next') }}: {{ __('Question 3') }}</h5>
                                    <p class="value">{{ __('Value') }}: 10</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 opt">
                <div class="box text-center d-flex align-items-center justify-content-center">
                    <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Last question') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked disabled>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Show in results') }}
                        </label>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
