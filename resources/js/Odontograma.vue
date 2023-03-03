<template>
    <div class="odontogram-container">
    <div class="teeth-row">
      <div class="tooth" v-for="tooth in upperLeft" :key="tooth.number">
        <div class="tooth-number">{{ tooth.number }}</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.mesial,
          'tooth-surface-filled': tooth.mesial && tooth.mesial.filled,
        }">M</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.distal,
          'tooth-surface-filled': tooth.distal && tooth.distal.filled,
        }">D</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.occlusal,
          'tooth-surface-filled': tooth.occlusal && tooth.occlusal.filled,
        }">O</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.buccal,
          'tooth-surface-filled': tooth.buccal && tooth.buccal.filled,
        }">B</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.lingual,
          'tooth-surface-filled': tooth.lingual && tooth.lingual.filled,
        }">L</div>
      </div>
    </div>
    <div class="teeth-row">
      <div class="tooth" v-for="tooth in upperRight" :key="tooth.number">
        <div class="tooth-number">{{ tooth.number }}</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.mesial,
          'tooth-surface-filled': tooth.mesial && tooth.mesial.filled,
        }">M</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.distal,
          'tooth-surface-filled': tooth.distal && tooth.distal.filled,
        }">D</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.occlusal,
          'tooth-surface-filled': tooth.occlusal && tooth.occlusal.filled,
        }">O</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.buccal,
          'tooth-surface-filled': tooth.buccal && tooth.buccal.filled,
        }">B</div>
        <div class="tooth-surface" :class="{
          'tooth-surface-missing': !tooth.lingual,
          'tooth-surface-filled': tooth.lingual && tooth.lingual.filled,
        }">L</div>
      </div>
    </div>
    <div class="teeth-row">
      <div class="tooth" v-for="tooth in lowerLeft" :key="tooth.number">
        <div class="tooth-number">{{ tooth.number }}</div>
        <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.mesial,
      'tooth-surface-filled': tooth.mesial && tooth.mesial.filled,
    }">M</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.distal,
      'tooth-surface-filled': tooth.distal && tooth.distal.filled,
    }">D</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.occlusal,
      'tooth-surface-filled': tooth.occlusal && tooth.occlusal.filled,
    }">O</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.buccal,
      'tooth-surface-filled': tooth.buccal && tooth.buccal.filled,
    }">B</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.lingual,
      'tooth-surface-filled': tooth.lingual && tooth.lingual.filled,
    }">L</div>
  </div>
</div>
<div class="teeth-row">
  <div class="tooth" v-for="tooth in lowerRight" :key="tooth.number">
    <div class="tooth-number">{{ tooth.number }}</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.mesial,
      'tooth-surface-filled': tooth.mesial && tooth.mesial.filled,
    }">M</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.distal,
      'tooth-surface-filled': tooth.distal && tooth.distal.filled,
    }">D</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.occlusal,
      'tooth-surface-filled': tooth.occlusal && tooth.occlusal.filled,
    }">O</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.buccal,
      'tooth-surface-filled': tooth.buccal && tooth.buccal.filled,
    }">B</div>
    <div class="tooth-surface" :class="{
      'tooth-surface-missing': !tooth.lingual,
      'tooth-surface-filled': tooth.lingual && tooth.lingual.filled,
    }">L</div>
  </div>
</div>
</div>
<div class="button-group">
          <button type="submit" class="btn btn-primary">Agregar</button>
          <a href="antecedente" type="cancelar" class="btn btn-secondary">Cancelar</a>
          <a href="diagn" type="button" class="btn btn-primary" @click="goToNextPage">Siguiente</a>
        </div>
</template>

<script>
export default {
  name: 'Odontogram',
  props: {
    upperLeft: Array,
    upperRight: Array,
    lowerLeft: Array,
    lowerRight: Array,
  },
};
</script>

<style scoped>
.odontogram-container {
  display: flex;
  flex-direction: column;
}

.teeth-row {
  display: flex;
}

.tooth {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 30px;
  height: 50px;
  border: 1px solid black;
}

.tooth-number {
  font-size: 14px;
margin-bottom: 5px;
}

.tooth-surface {
font-size: 12px;
width: 20px;
height: 20px;
border: 1px solid black;
display: flex;
justify-content: center;
align-items: center;
}

.tooth-surface-missing {
background-color: #e6e6e6;
}

.tooth-surface-filled {
background-color: #b3ffb3;
}
</style>
