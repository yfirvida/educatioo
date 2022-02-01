<div>
    <div class="content-wrapper">
        <div class="content ">
            <h2 class="mb-3">{{ __('Edit Course') }}</h2>
            <h5 class="">{{ __('Course Name') }}</h5>
                <input type="text" name="name" class="dotted-input w-100 mb-3 mt-2" value="Lorem ipsum dolor">
            <h5 >{{ __('Instruction') }}</h5>
                <textarea rows="3" class="dotted-input w-100 mt-2">Lorem ipsum dolor sit amet, facer timeam cu mea, eu dicta tamquam sea, nec no doctus dolorem. Mandamus patrioque te duo. Nec case explicari constituto te. Impedit sensibus aliquando mel an, suas voluptaria referrentur duo no. Ad tritani veritus accommodare vis.</textarea> 
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
                                <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                <div class="wrapper"><img src=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h4>{{ __('Question 1') }}</h4>
                                <p class="value">{{ __('Value') }}</p>
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
                                <textarea rows="4" class="form-control w-100">Curabitur ullamcorper ultricies nisi. </textarea>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <div class="img-wrapper">
                                    <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                    <div class="wrapper"><img src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <select class="form-select" aria-label="    ">
                                    <option selected>Question 2</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                                <input type="text" name="" class="form-control mt-2" value="8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 opt">
                <div class="box text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Last question') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Show in results') }}
                        </label>
                    </div>
                    <div class="icons-wrapper mt-2">
                        <a href="#" class="mr-2"><i class="far fa-trash-alt"></i></a>
                        <a href="#"><i class="far fa-edit"></i></a>
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
                                <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                <div class="wrapper"><img src=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h4>{{ __('Question 1') }}</h4>
                                <p class="value">{{ __('Value') }}</p>
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
                                <textarea rows="4" class="form-control w-100">Curabitur ullamcorper ultricies nisi. </textarea>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <div class="img-wrapper">
                                    <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                    <div class="wrapper"><img src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <select class="form-select" aria-label="    ">
                                    <option selected>Question 2</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                                <input type="text" name="" class="form-control mt-2" value="8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 opt">
                <div class="box text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Last question') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Show in results') }}
                        </label>
                    </div>
                    <div class="icons-wrapper mt-2">
                        <a href="#" class="mr-2"><i class="far fa-trash-alt"></i></a>
                        <a href="#"><i class="far fa-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="actions-wrapper">
        <div class="col-md-3 offset-9 actions">
           <div class="box text-center"> 
            <a href="#" class="btn btn-orange w-100" >
                <i class="far fa-question-circle mr-2"></i>
                {{ __('Add new question') }}
            </a>
            <a href="#" class="btn btn-white w-100 mt-2">   
                {{ __('Save Course') }}
            </a>
            </div>
        </div>
    </div>
</div>

