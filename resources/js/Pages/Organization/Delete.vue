<template>
  <div>
    <jet-danger-button
      variant="outline"
      @click.native="confirmOrganizationDeletion"
    >
      Delete Organization
    </jet-danger-button>

    <!-- Delete Confirmation Modal -->
    <jet-dialog-modal
      :show="confirmingOrganizationDeletion"
      @close="closeModal"
    >
      <template #title>
        Delete Organization
      </template>

      <template #content>
        Are you sure you want to delete origanization?
      </template>

      <template #footer>
        <jet-secondary-button @click.native="closeModal">
          Nevermind
        </jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          @click.native="deleteOrganization"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Delete Organization
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: {
    organizationId: {
      type: String | Number,
      required: true
    }
  },

  components: {
    JetDangerButton,
    JetDialogModal,
    JetSecondaryButton
  },

  data() {
    return {
      confirmingOrganizationDeletion: false,
      form: this.$inertia.form({})
    };
  },

  methods: {
    confirmOrganizationDeletion() {
      this.confirmingOrganizationDeletion = true;
    },

    deleteOrganization() {
      this.form.delete(route("organizations.destroy", this.organizationId), {
        preserveScroll: true,
        onSuccess: () => this.closeModal()
      });
    },

    closeModal() {
      document.body.style.overflow = null;

      this.confirmingOrganizationDeletion = false;
    }
  }
};
</script>
