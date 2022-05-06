<script>
import { text } from "body-parser";

export default {
  props: {
    show: Boolean,
    reply_to: String,
    reply_to_id: Number
  },
  methods:{
        show_Modal(comment_id,user_name) {
            this.showModal = true;
            this.reply_to = user_name;
            this.reply_to_id = comment_id;
            $emit('close');
        }
    }
}
</script>

<template>
  <Transition name="modal">
    <div v-if="show" class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-body">
            <slot name="body">
                <h3 style="margin-bottom: 20px;">Leave reply to <Strong>{{reply_to}}</Strong></h3>
                <form>
                    <div class="form-group">
                        <label for="user_name">Your Name</label>
                        <input type="text" class="form-control" id="user_name" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea type="password" class="form-control" id="comment" placeholder="Enter your comments..."></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="post_comment_id" :value="reply_to_id" >
                    <div class="form-group">
                        <input style="margin:10px" type="button"  class="btn btn-secondary modal-default-button"  @click="$emit('close')" value="Cancel">
                        <input style="margin:10px" type="button"  class="btn btn-primary modal-default-button"  @click="$emit('close')" value="Send">
                    </div>
                </form>

            </slot>
          </div>
        </div>
      </div>
    </div>
  </Transition>
</template>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 500px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
