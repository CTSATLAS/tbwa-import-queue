<?= $this->Html->script('moment', array('inline' => false)) ?>
<script src="/import_queue/js/imports/admin_index.js"></script>

<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th { vertical-align: middle }

    .dataTables_filter .form-control {
        height: 20px !important;
    }

    .dropdown-menu li,
    tr { cursor: pointer; }

    .tab-content { margin-top: 18px }

    .dropdown-submenu {
        position:relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top:0;
        left:100%;
        margin-top:-6px;
        margin-left:-1px;
        -webkit-border-radius:0 6px 6px 6px;
        -moz-border-radius:0 6px 6px 6px;
        border-radius:0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display:block;
    }

    .dropdown-submenu>a:after {
        display:block;
        content:" ";
        float:right;
        width:0;
        height:0;
        border-color:transparent;
        border-style:solid;
        border-width:5px 0 5px 5px;
        border-left-color:#cccccc;
        margin-top:5px;
        margin-right:-10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color:#ffffff;
    }

    .dropdown-submenu.pull-left {
        float:none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left:-100%;
        margin-left:10px;
        -webkit-border-radius:6px 0 6px 6px;
        -moz-border-radius:6px 0 6px 6px;
        border-radius:6px 0 6px 6px;
    }

    .select2-container.form-control {
        display: inline-block;
        width: 250px !important;
    }
</style>

<div class="col-sm-12 bleach">
    <div class="container-fluid">
        <?php $flash = $this->Session->flash() ?>
        <?php if(!empty($flash)): ?>
            <div class="row">
                <div class="col-sm-12 bleach">
                    <?= $flash; ?>
                </div>
            </div>
        <?php endif ?>

        <div class="row">
            <div class="col-sm-12 bleach">
                <h1 style="margin-top: 18px;">
                    Import Queue
                </h1>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 bleach" style="position: relative;">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#open" aria-controls="open" role="tab" data-toggle="tab">Open</a>
                    </li>

                    <li role="presentation">
                        <a href="#archived" aria-controls="closed" role="tab" data-toggle="tab">Archived</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="open">
                        <table id="open-table" class="table">
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>SSN</th>
                                    <th>Extra Params</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="archived">
                        <table id="archived-table" class="table">
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>SSN</th>
                                    <th>Extra Params</th>
                                    <th>Processed On</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="note-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="dialog" aria-label="close"><span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Add a note</h4>
                </div>

                <div class="modal-body">
                    <p>Use this field to add a note to the customer's record.</p>

                    <textarea class="form-control" name="note-body" id="status_notes" placeholder="Optional" cols="30" rows="5"></textarea>
                    <small class="text-muted">This may be shared with the customer.</small>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary save-button" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>


    <style>
        .twitter-typeahead {
            display: block !important;
        }

        .typeahead,
        .tt-query,
        .tt-hint {
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.425;
            border: 2px solid #ccc;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            outline: none;
        }

        .typeahead {
            background-color: #fff;
        }

        .typeahead:focus {
            border: 2px solid #0097cf;
        }

        .tt-query {
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
            color: #999
        }

        .tt-menu {
            width: 840px;
            margin: 0;
            padding: 8px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            box-shadow: 0 5px 10px rgba(0,0,0,.2);
        }

        .tt-suggestion {
            padding: 3px 20px;
            font-size: 18px;
            line-height: 24px;
        }

        .tt-suggestion:hover {
            cursor: pointer;
            color: #fff;
            background-color: #0097cf;
        }

        .tt-suggestion.tt-cursor {
            color: #fff;
            background-color: #0097cf;

        }

        .tt-suggestion p {
            margin: 0;
        }

        .gist {
            font-size: 14px;
        }

        /* example specific styles */
        /* ----------------------- */

        #custom-templates .empty-message {
            padding: 5px 10px;
            text-align: center;
        }

        #multiple-datasets .league-name {
            margin: 0 20px 5px 20px;
            padding: 3px 0;
            border-bottom: 1px solid #ccc;
        }

        #scrollable-dropdown-menu .tt-menu {
            max-height: 150px;
            overflow-y: auto;
        }

        #rtl-support .tt-menu {
            text-align: right;
        }
    </style>

    <div class="modal fade" id="new-activity-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="dialog" aria-label="close"><span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Assign Online Program</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" action="/admin/user_transactions/new" method="POST">
                        <input type="hidden" name="data[UserTransaction][user_id]" id="UserTransactionUserId">
                        <div class="form-group" style="margin: 0 0 12px 0">
                            <select style="width: 100%" name="data[UserTransaction][program_id]" id="UserTransactionProgramId" class="select2" placeholder="Select an online program to assign to the customer">
                                <option></option>
                                <?php foreach ($bluedropProducts as $product): ?>
                                    <option value="<?= $product->id ?>"><?= $product->name ?></option>
                                <?php endforeach ?>
                            </select>

                            <input type="hidden" name="data[UserTransaction][details]" id="UserTransactionDetails">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary save-button" type="button">Assign Online Program</button>
                </div>
            </div>
        </div>
    </div>
</div>