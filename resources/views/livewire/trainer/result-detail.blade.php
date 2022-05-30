<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-between align-items-end mt-3 ">
                <h2>{{$exam->name}}</h2>
                <h3>{{$exam->class}}</h3>
            </div>
        </div>
        <div class="content">
            <div class="table-responsive mt-4">
                <table class="table  ">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="d-flex justify-content-between align-items-center">
                                    {{ __('Name') }}
                                    <div class="ml-3">
                                        {{ __('Score %') }}
                                    </div>
                                </div>
                            </th>
                            @if($questions && $questions->count() > 0)
                                <?php $i = 1;?>
                                @foreach($questions as $q) 
                                    <th scope="col" class="text-center q_th" wire:click="showQuestion({{$q->id}})">
                                        <span class="question_head" >{{$i}}</span>
                                    </th>
                                    <?php $i++ ; ?>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                       @if($students && $students->count() > 0)
                            @foreach($students as $student) 
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            {{$student->name}}
                                            <div class="ml-3">
                                                @if($student->aproved)
                                                    <i class='fas fa-check' style='font-size:12px; color:green'></i>
                                                @endif
                                                {{$student->total}} %
                                            </div>
                                        </div>
                                    </td>
                                    @if($questions && $questions->count() > 0)
                                        @foreach($questions as $q) 
                                            <td class="p-1">
                                            @if($student->detail != null)
                                                <div class='<?php if($student->detail[$q->id]->correct): echo "green"; else: echo "red"; endif; ?> text-center' >
                                                    @if($student->detail[$q->id]->correct)
                                                        <i class='fas fa-check' style='font-size:12px; color:green'></i> 
                                                    @else
                                                        <i class='fas fa-times' style='font-size:12px; color:red'></i> 
                                                    @endif
                                                    {{$student->detail[$q->id]->answer}}
                                                <div>
                                            @endif
                                            </td>
                                        @endforeach
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{_('No results')}}</td>
                            </tr> 
                        @endif 
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- question modal -->
<div wire:ignore.self class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header py-3 pb-0">
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pb-3">
                <div class="inside-form text-center d-flex align-items-center justify-content-center">  
                    @if($current_question && $current_question->count() > 0 )
                        <div>
                            <h2 class=" mb-4">{{$current_question->question}}</h2>
                            @if($current_question->image )
                            <div class="wrapper">
                                <img class="position-relative mx-auto centered" src="<?php echo Theme::url('storage/questions'); ?>/{{$current_question->image}}">
                            </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>

</div>

@push('scripts')
    <script>
        window.addEventListener('openModal', event => {         
            $('#questionModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#questionModal').modal('hide');
        });
        
    </script>
@endpush
