<template>
    <h1>Odontogram</h1>
    <div class="odontogram text-center">
        <table>
            <tr>
                <th></th>
                <th>18</th>
                <th>17</th>
                <th>16</th>
                <th>15</th>
                <th>14</th>
                <th>13</th>
                <th>12</th>
                <th>11</th>
                <th>21</th>
                <th>22</th>
                <th>23</th>
                <th>24</th>
                <th>25</th>
                <th>26</th>
                <th>27</th>
                <th>28</th>
            </tr>
            <tr>
                <td>U</td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk">Milk</option>
                    </select>
                    <textarea
                        class="form-control observation"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk" selected>Milk</option>
                    </select>
                    <textarea
                        class="form-control observation milk-teeth"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk" selected>Milk</option>
                    </select>
                    <textarea
                        class="form-control observation milk-teeth"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk" selected>Milk</option>
                    </select>
                    <textarea
                        class="form-control observation milk-teeth"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk" selected>Milk</option>
                    </select>
                    <textarea
                        class="form-control observation milk-teeth"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk" selected>Milk</option>
                    </select>
                    <textarea
                        class="form-control observation milk-teeth"
                        placeholder="Observations"
                    ></textarea>
                </td>
                <td>
                    <select class="form-control">
                        <option value="permanent">Permanent</option>
                        <option value="milk" selected>Milk</option>
                    </select>
                    <textarea
                        class="form-control observation milk-teeth"
                        placeholder="Observations"
                    ></textarea>
                </td>
            </tr>
        </table>
        <div class="form-group">
            <label for="name">Patient Name</label>
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter patient name"
            />
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input
                type="number"
                class="form-control"
                id="age"
                placeholder="Enter patient age"
            />
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender">
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input
                type="date"
                class="form-control"
                id="date"
                placeholder="Enter date"
            />
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" rows="3"></textarea>
        </div>
        <button type="button" class="btn btn-primary">Save</button>
    </div>
</template>

<script></script>

<style scoped>
body {
    background-color: #f2f2f2;
}
h1 {
    text-align: center;
    color: #007bff;
    margin-top: 50px;
}
.odontogram {
    margin: 50px auto;
    max-width: 2000px;
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
}
table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    font-size: 14px;
    margin-bottom: 30px;
}
th,
td {
    padding: 5px;
    border: 1px solid #dee2e6;
}
th {
    background-color: #007bff;
    color: #fff;
}
.milk-teeth {
    color: #c5c5c5;
}
.observation {
    width: 100%;
    margin-top: 5px;
}
.form-control:focus {
    border-color: #007bff;
    box-shadow: none;
}
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}
.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}
</style>

¿
