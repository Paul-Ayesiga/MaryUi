const ModalComponent = {
    template: `
    <div class="modal" v-if="show">
      <div class="modal-content">
        <button @click="$emit('close')">Close</button>
      </div>
    </div>
  `,
    props: {
        show: {
            type: Boolean,
            required: true
        }
    }
};

export default ModalComponent;
