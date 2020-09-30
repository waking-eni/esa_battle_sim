<div class="modal fade" id="newArmy" tabindex="-1" role="dialog" aria-labelledby="edit-user-modal-label" aria-hidden="true">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

          <form name="army_form" action="api/army/create.php" method="post" role="form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">New Army</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">                  
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter name">                  
                </div>

                <div class="form-group">
                      <label for="units">Units:</label>
                      <input type="text" class="form-control" id="units" placeholder="Enter units">
                </div>

                <div class="form-group">
                    <label for="attack_strategy">Choose an attack strategy:</label>
                        <select name="attack_strategy" id="attack_strategy" form="army_form">
                        <option value="random">Random</option>
                        <option value="weakest">Weakest</option>
                        <option value="strongest">Strongest</option>
                        </select>
                </div>
            </div>

            <div class="modal-footer">
                <input id="submit" name="submit" type="submit" value="Ok" class="btn btn-warning">
            </div>

          </form>

      </div>

    </div>
</div>