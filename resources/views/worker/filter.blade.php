<div class="filter-panel">
    <div class="panel panel-default">
        <div class="panel-body">
                {!! Form::open(array('class'=>'navbar-form navbar-left','role'=>'search')) !!}
                <div class="form-group">
                    Город:
                    <select class="form-control" name="city" id="cities">
                        <option value="0">Все города</option>
                    </select>
                </div>
                <div class="form-group">
                    Отделение:
                    <select class="form-control" name="department" id="departments">
                        <option value="0">Все отделения</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Отправить</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>