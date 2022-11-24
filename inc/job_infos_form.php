<div class="hcf_box">
    <style scoped>
    .hcf_box {
        display: grid;
        grid-template-columns: max-content 1fr;
        grid-row-gap: 10px;
        grid-column-gap: 20px;
    }

    .hcf_field {
        display: contents;
    }
    </style>

    <p class="meta-options hcf_field">
        <label for="jp_place">Ville</label>
        <input id="jp_place" type="text" name="jp_place"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_completeAddress">Adresse complete</label>
        <input id="jp_completeAddress" type="text" name="jp_completeAddress"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_completeAddress', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_postalCode">Code postal</label>
        <input id="jp_postalCode" type="text" name="jp_postalCode"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_postalCode', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_addressRegion">Région</label>
        <input id="jp_addressRegion" type="text" name="jp_addressRegion"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_addressRegion', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_startDate">Date de début</label>
        <input id="jp_startDate" type="date" name="jp_startDate"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_startDate', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_validThrough">Date de fin de validité</label>
        <input id="jp_validThrough" type="date" name="jp_validThrough"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_validThrough', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_contract">Type de contrat</label>
        <input id="jp_contract" type="text" name="jp_contract"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_remote">Télétravail</label>
        <input id="jp_remote" type="text" name="jp_remote"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_remote', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_salary">Rémunération</label>
        <input id="jp_salary" type="text" name="jp_salary"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_salary', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="jp_experience">Expérience requise</label>
        <input id="jp_experience" type="text" name="jp_experience"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_experience', true ) ); ?>">
    </p>
</div>