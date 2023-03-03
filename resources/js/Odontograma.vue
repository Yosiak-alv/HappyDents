<template>
   <div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h2>Upper Teeth</h2>
      <div class="odontogram">
        <div class="tooth" v-for="tooth in upperTeeth" :class="tooth.status">
          <span class="tooth-number">{{ tooth.number }}</span>
          <span class="tooth-name">{{ tooth.name }}</span>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <h2>Lower Teeth</h2>
      <div class="odontogram">
        <div class="tooth" v-for="tooth in lowerTeeth" :class="tooth.status">
          <span class="tooth-number">{{ tooth.number }}</span>
          <span class="tooth-name">{{ tooth.name }}</span>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
export default {
  data() {
    return {
      upperTeeth: [
        { number: 18, name: "Right Maxillary Third Molar", status: "missing" },
        { number: 17, name: "Right Maxillary Second Molar", status: "filled" },
        { number: 16, name: "Right Maxillary First Molar", status: "crown" },
        { number: 15, name: "Right Maxillary Second Premolar", status: "extraction" },
        { number: 14, name: "Right Maxillary First Premolar", status: "cavity" },
        { number: 13, name: "Right Maxillary Canine", status: "cavity" },
        { number: 12, name: "Right Maxillary Lateral Incisor", status: "crown" },
        { number: 11, name: "Right Maxillary Central Incisor", status: "filled" },
      ],
      lowerTeeth: [
        { number: 48, name: "Right Mandibular Third Molar", status: "cavity" },
        { number: 47, name: "Right Mandibular Second Molar", status: "extraction" },
        { number: 46, name: "Right Mandibular First Molar", status: "cavity" },
        { number: 45, name: "Right Mandibular Second Premolar", status: "filled" },
        { number: 44, name: "Right Mandibular First Premolar", status: "crown" },
        { number: 43, name: "Right Mandibular Canine", status: "cavity" },
        { number: 42, name: "Right Mandibular Lateral Incisor", status: "filled" },
        { number: 41, name: "Right Mandibular Central Incisor", status: "cavity" },
      ],
    };
  },
};
``

</script>

<style scoped>
.odontogram {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  background-color: #fff;
  border: 1px solid #0077be;
  border-radius: 5px;
  padding: 20px;
  margin-bottom: 30px;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
}

.odontogram-upper {
  background-color: #0077be;
}

.odontogram-lower {
  background-color: #fff;
}

.tooth {
  width: 35px;
  height: 50px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-size: 12px;
  font-weight: bold;
  color: #fff;
  border-radius: 3px;
  margin-bottom: 10px;
  text-align: center;
}

.tooth-number {
  font-size: 18px;
  margin-bottom: 5px;
}

.tooth-name {
  font-size: 16px;
}

.missing {
  background-color: #0077be;
}

.filled {
  background-color: #0d6efd;
}

.crown {
  background-color: #ffc107;
}

.cavity {
  background-color: #dc3545;
}

.extraction {
  background-color: #000;
}

.text-center {
  text-align: center;
}

.mb-4 {
  margin-bottom: 1.5rem !important;
}

</style>
